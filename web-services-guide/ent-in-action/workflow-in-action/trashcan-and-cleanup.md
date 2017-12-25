---
layout: chapter
title: Trash Can & Clean Up [since 8.0]
sortid: 050
permalink: doc1052
---

Enterprise 7 allows system admin users to manage deleted objects through the admin pages. Enterprise 8 exposes that 
functionality to brand users and end users as well. Users can restore objects or delete objects permanently from the 
Trash Can.

Objects can be owned by Brands, assigned to Issues, classified by Categories, etc. Those entities cannot be removed as 
long they are occupied by objects, regardless of wether they in the workflow or in the Trash Can. Clean Up features help 
to move objects elsewhere or delete them.

Configuration and migration details of the Trash Can and Auto Purge feature can be found in the Admin Guide.

## Object properties

There are two new object properties introduced to track deleted objects:
* ***Deleted On (Deleted):*** Date-time stamp when the object has been deleted. Used to filter objects in the Trash Can. 
This is similar to the Created On (Creator) and Modified On (Modifier) properties.
* ***Deleted By (Deleter):*** User who deleted the object. Used to determine which objects reside in the user’s individual 
Trash Can. This is similar to the Created By (Creator) and Modified By (Modifier) properties.

When an object is deleted, both properties will be automatically filled in by the server. When an object is restored, 
the properties remain untouched, so they provide information on the last delete operation.

## Workflow dialogs

Like the Delete operation (and unlike other workflow operations) there is no workflow dialog raised for Restore- and 
Delete Permanent operations. So there is no dialog configuration for it either.

The two new properties (Deleter and Deleted) are determined by the system. Therefore, they are always read-only when 
shown at workflow dialogs.

## Dialog Setup / Query Setup

The following changes are made to the Action pull-down menu of the Dialog Setup page:
* ***Query Result Columns for Trash Can***: New option used to configure columns to show at the search results of the 
Trash Can. Unlike other query results, this one allows adding Deleted and Deleter columns.
* ***Query Result Columns for Web***: No longer available since the Web pages are superseded by Content Station.
* ***Query Result Columns for Smart Browser***: No longer available since Smart Browser is superseded by Content Station.

## Access rights

Under the File Access section of the Profile Maintenance page, there is one additional option named “Delete Permanently” 
(internally called “Purge”). For existing, migrated and new profiles, this option is disabled by default. When enabled, 
it allows users to remove objects from the Trash Can.

The existing profile option “Delete” has an additional meaning. It also indicates whether the user can Restore objects 
from the Trash Can.

Note that access rights options only affect brand admins and end-users. Not system admins.

## Integration

The server reports all kinds of problems back to clients so they can ask the user for confirmation or just inform the 
user to what extent the operation was successful.

The server is backwards compatible with v7 clients which only know about SOAP faults. Those clients simply raise errors 
instead of confirmations. No objects are listed in the dialogs. The server tries to apply the operation for all objects, 
even when an error has occurred.

The following changes are made to the workflow interface (SCEnterprise.wsdl):
* ***AreaType***: New type introduced to filter objects from the Trash Can. Currently supported values are Workflow and Trash.
* ***WorkflowMetaData***: Has new object properties: Deleter and Deleted that are set when the object is deleted.
* ***QueryObjects***: Request has a new Areas parameter used to query objects from the Trash Can.
* ***NamedQueries***: Queries for Trash Can do not travel through Named Queries. Use QueryObjects instead.
* ***RestoreObjects***: New service that restores objects from the Trash Can back into the workflow.
* ***DeleteObjects service:*** Since deleted objects do not leave the system yet, client applications might want to know 
what happened (for example to update the Trash Can that is currently still opened in the background). Therefore this 
service returns objects that are deleted (which is a change). A new “Areas” parameter tells if the object needs to be 
deleted from the workflow (v7.0 behavior) or needs to be deleted permanently from the Trash Can.

The combinations of parameter values result in the following system operations:

  Permanent      | Areas             | System operation
  ---------------| ------------------| ----------------------------
  1              | Workflow          | Permanently delete
  1              | Trash             | Permanently delete
  1              | Workflow + Trash  | Error (not supported)
  0              | Workflow          | Delete (send to Trash Can)
  0              | Trash             | Error (makes no sense)
  0              | Workflow + Trash  | Error (not supported)

* ***GetObjects***: Request has a new “Areas” parameter that allows to get the thumbnail and preview for objects listed in Trash Can.
* ***GetDialog***: Request has a new “Areas” parameter that allows to get properties for objects listed in Trash Can as 
configured for the Preview dialog (at Dialog Setup).
* ***GetVersion***: Request has a new “Areas” parameter that allows to view a version of an object in the Trash Can.
* ***ListVersions***: Request has a new “Areas” parameter that allows to request for all versions of an object in the Trash Can.

## Live updates / N-casting

To support live updates between Search results, Inbox and Trash Can, some changes have been made to the messages that 
are broadcasted or multi-casted over the network to all client applications listening for updates:

* ***DeleteObject (\#4)*** - Before v8, the ID was sent only. Since v8, the following properties are sent: ID (object), 
Type (object) \[1\], Name (object), PublicationId, IssueIds, EditionIds, SectionId, StateId, Deleted, Deleter, 
RouteTo (user), LockedBy (user), Version (object), UserId and Permanent \[9\].
  * \[9\] The Permanent property is set ‘true’ when the object is deleted permanently, or ‘false’ when the object is 
  deleted (sent to Trash Can).
* ***RestoreObject (\#23)*** - New event, fired for each object that was restored from the Trash Can. Aside from the 
default set of properties, Deleted and Deleter properties are sent too.

## Server Plug-ins

There are new connector types added that can be implemented by connectors of server plug-ins, and for two existing 
connector types the behavior has changed:
* ***WflRestoreObjects\_EnterpriseConnector\****: New connector type. Called when user restores objects from the Trash Can. 
Called only once for multiple selected objects.
* ***WflDeleteObjects\_EnterpriseConnector\****: Existing connector type. Now also called when a user deletes objects 
permanently from the Trash Can. So checking the new Areas parameter is required.
* ***WflSetObjectProperties\_EnterpriseConnector***: Existing connector type. Now also called when an admin moves objects 
from one issue or category to another. Can also be called for objects in the Trash Can. So checking the new Areas 
parameter is required.

For the restore and delete connectors, the new Deleted and Deleter object properties will be set and are accessible through:

`$response->Objects[n-1]->MetaData->WorkflowMetaData`

Note that for all connectors, the ID, IDs and Params elements are flattened to just IDs. That means, no matter what 
client applications send, the server will make sure the IDs are set (resolved from others) and others are made null. 
When IDs is null, it means ‘for all objects’.

## Handling errors for multiple objects

Assume the user has made a multiple selection of some objects and does a Delete or Restore operation, for which some 
objects have no problems, while some others have errors.

**v8 client with v8 server**

For a v8 client talking to v8 server, the SOAP messages looks like the examples below.

The initial request:

```xml
<DeleteObjects>
	<Ticket>...</Ticket>
	<IDs><String>51</String><String>52</String><String>53</String></IDs>
	<Permanent>false</Permanent>
	<Params xsi:nil=”true”/>
	<Areas><Area>Workflow</Area></Areas>
</DeleteObjects>
```

The response for which an error dialog and confirmation dialog is raised:

```xml
<DeleteObjectsResponse>
	<IDs>
		<String>51</String>
		<String>53</String>
	</IDs>

	<Reports>
		<ErrorReport>
			<BelongsTo>
				<Type>Object</Type>
				<ID>52</ID>
				<Name xsi:nil="true"/>
				<Role xsi:nil="true"/>
			</BelongsTo>
			<Entries>
				<ErrorReportEntry>
					<Entities/>
					<Message>Access denied (S1002)</Message>
					<Details/>
					<ErrorCode>S1002</ErrorCode>
					<MessageLevel>Warning</MessageLevel>
				</ErrorReportEntry>
			</Entries>
		</ErrorReport>
	</Reports>
</DeleteObjectsResponse>
```

Note that there can still be SOAP faults instead of responses, for example when the ticket has expired. Errors mentioned 
above are about individual objects causing problems only.

**v7 client with v8 server**

For a v7 client talking to a v8 server, the SOAP messages looks like the examples below.

The initial request:

```xml
<DeleteObjects>
	<Ticket>...</Ticket>
	<IDs><String>51</String><String>52</String><String>53</String></IDs>
	<Permanent>false</Permanent>
</DeleteObjects>
```

The responses for which one error dialog is raised:

```xml
<SOAP-ENV:Fault>
	<faultcode>SOAP-ENV:Client</faultcode>
	<faultstring>Access denied (S1002)\nObject locked (Sxxxx)</faultstring>
	<faultactor/>
	<detail>53 (D)\n52</detail>
</SOAP-ENV:Fault>
```

As you can see, there is no longer a DeleteObjectsReponse but a true SOAP fault. All errors are collected and returned 
once. When there are many objects, it would be very hard for users to resolve the problem(s) and retry. This happens 
during migrations so it is a temporary problem.

## Empty the Trash Can

Client applications can use the Params element to implicitly specify all objects that fit in the current search results 
the user is facing. Or they can use IDs element to explicitly specify the objects the user has selected. For example, 
some objects selected by the user or, all objects that fit on the first page of the search results. When both IDs and 
Params elements are set to nil, Permanent is 'true' and Areas is 'Trash', then the entire Trash Can is emptied.

To prevent many server plug-ins from having to resolve which object IDs are involved, the server calls QueryObjects 
internally (on service level) to resolve the IDs. It then passes through the IDs and nullifies the Params element. 
In other terms, server plug-in may assume that the IDs element is always set.

Empty the system’s Trash Can:

```xml
<DeleteObjects>
	<Ticket>...</Ticket>
	<IDs xsi:nil=”true”/>
	<Permanent>true</Permanent>
	<Params xsi:nil=”true”/>
	<Areas><Area>Trash</Area></Areas>
</DeleteObjects>
```

Trash the current query results:

```xml
<DeleteObjects>
	<Ticket>...</Ticket>
	<IDs xsi:nil=”true”/>
	<Permanent>false</Permanent>
	<Params>...</Params> <!-- current query params used -->
	<Areas><Area>Workflow</Area></Areas>
</DeleteObjects>
```

Empty objects from Trash Can that were deleted by someone specific:

```xml
<DeleteObjects>
	<Ticket>...</Ticket>
	<IDs xsi:nil=”true”/>
	<Permanent>true</Permanent>
	<Params>
		<Param>
			<Property>Deleter</Property>
			<Operation>=</Operation>
			<Value>John</Value>
			<Special xsi:nil=”true”/>
		</Param>
	</Params>
	<Areas><Area>Trash</Area></Areas>
</DeleteObjects> 
```

Empty objects from Trash Can that are owned by a specific brand:

```xml
<DeleteObjects>
	<Ticket>...</Ticket>
	<IDs xsi:nil=”true”/>
	<Permanent>true</Permanent>
	<Params>
		<Param>
			<Property>PublicationId</Property>
			<Operation>=</Operation>
			<Value>123</Value>
			<Special xsi:nil=”true”/>
		</Param>
	</Params>

	<Areas><Area>Trash</Area></Areas>
</DeleteObjects>    
```