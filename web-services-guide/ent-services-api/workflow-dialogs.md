---
layout: chapter
title: Workflow Dialogs
---
Through Dialog Setup pages, system administrators can configure workflow dialogs per Brand, object type and action. When a client is about to show a workflow dialog, such definitions are requested through the GetDialog workflow service (as specified in the SCEnterprise.wsdl). Whenever the user selects another Brand, Issue, Category or status, the client requests for that dialog definition (requesting for GetDialog again) and redraws the entire dialog.

For Brand and overrule Issue selections, the redraw is needed because the entire workflow definition and dialog configuration could be different. For (normal) Issue selections the list of requested Dossiers could differ. For status- and Category changes, the Route To selection could differ. And, in all cases, the editable/read-only status could differ due to access rights.

System integrators can overrule the standard server behavior of the GetDialog service through server plug-ins. This is why clients should have no logics nor assume or predict certain behavior. Instead, they should listen to the GetDialog response and fully rely on that. The LogOn response should no longer be used by any v7 client to get definitions in relation to workflow dialogs. Also, there is no reason anymore to call the GetStates service since that is embraced by the GetDialog service.

## History

-   Since v5.0, the GetDialog service was introduced and used by the Web Editor only.

-   Since v6.0, Publication Channel awareness has been added to the GetDialog service. Content Station started using it (but is still using the LogOn response too to build dialogs).

-   Since v7.0, new features have been added to the service and InDesign / InCopy clients started using the service. The service itself is also improved and logics are moved from the clients to the service:

    -   The returned PublicationInfo element tree has been pruned, clarifying what response information should be used by the clients.

    -   The enabled status of properties is determined by the service (instead of the clients).

    -   The Route To pre-selection is determined by the service (instead of the clients).

## GetDialog service

  **Element structure**  | **Description**
  -----------------------| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  Ticket                 | \[Mandatory\] The ticket as retrieved through the LogOn response.
  ID                     | Object ID. Nil for Create action. Mandatory for any other action.
  Publication            | Publication ID. Nil when ID, Layout or Template is provided, but is mandatory to redraw dialog.
  Issue                  | Issue ID. Nil for initial draw. Mandatory to redraw the dialog.
  Section                | Section ID. Nil for initial draw. Mandatory to redraw the dialog.
  State                  | \[v7.0\] Status ID. Nil for initial draw. Mandatory to redraw the dialog.
  Type                   | Object type.
  Action                 | Workflow operation. See Action definition for possible values. The empty value is not allowed in this context. For Save-As operations, the Create action should be used.
  RequestDialog          | Request for Dialog element at response time.
  RequestPublication     | Request for Publications and PublicationInfo elements at response time.
  RequestMetaData        | Request for MetaData element at response time. (Has no impact on Dialog-&gt;MetaData.)
  RequestStates          | Request for GetStatesResponse element at response time.
  RequestTargets         | \[v6.0\] Request for the Targets property (PropertyUsage element) at response time. Clients should pass “true” when they support the complex target widget that holds the Issues and Editions. The server determines where the Targets property should be placed in the dialog. Clients should then ignore the Issues and Editions property positions.
  DefaultDossier         | \[v7.0\] Dossier object ID. Request to populate the Dossiers element at response time as well as to return the Dossier property at the Dialog definition. The given Publication, Issue and Section are used to get Dossiers. The DefaultDossier is also used to set the default value as the Dossier property. If DefaultDossier is nil (or left out) no Dossier property nor Dossiers will be returned. See also \[1\].
  Parent                 | \[v7.0\] Parent object ID. In the specific case when creating objects that are already placed (such as creating articles from a layout) the client knows that the object will be placed, but the server does not know yet. (Existing placement relations are resolved server-side.) When the Parent has targets, the RelatedTargets will hold targets of this additional parent too. And, instead of the current Issue, the parent’s Issue is preselected (returned through GetDialogResponse -&gt; Targets). This is because placed objects are assumed to travel along with their parents. Also, the Brand / Category are taken from the Parent when Publication / Section are not given. When the Parent is a Layout Module (or Layout Module Template) the Brand, Issue and Editions are inherited. The Publication and Issue parameters are then ignored.
  Template               | \[v7.0\] Template object ID. Should only be given when Action = “Create”; else nil. When creating objects, most MetaData should be taken from a template. Those should be pre-filled for the new object in the Create workflow dialog. Provide the object ID of the template (that was picked by user) to let the server inherit its MetaData structure. Nil (or left out) means that the object is not created from the template. For Save As operations, the Template parameter can be used to pass the original object ID from which the MetaData will be inherited. Unlike the Parent parameter, the template’s Issue is not used for preselection. This is because in most cases there is a special templates issue, or templates do not have an Issue assigned.

\[1\] 'Dossier' is a property introduced in v7.0 and can be configured in the Dialog Setup Maintenance page. When a dialog is not customized, a default dialog is assumed by the server, which now also includes the Dossier property. Unlike other properties, the Dossier property is only shown in the dialogs when useful. That is, when the client and server can both handle it. If one doesn’t, the Dossier property won’t be shown in the dialog.

For client side, that means it is able to:
* Parse the Dossiers element in the GetDialog response.
* Draw a pull-down widget populated with those Dossiers.
* Pass the chosen Dossier ID (by the end user) through the object relations of the next request. For the Create dialog, that is the CreateObjects request.

For server-side, that means it is able to:
* Support the Object-in-Dossier relation. For example, for v7.0, Dossier-in-Dossier is not supported, and so Dossier and DossierTemplate objects won’t get a Dossier property.
* Support implicit Dossier creation for ‘next’ called service. Since v7.0. this is implemented for the CreateObjects service, and so, only for Create dialogs, the Dossier property is shown.

When a client does meet all its criteria listed above, it passes 0 (zero) or a valid Dossier ID for the DefaultDossier parameter; else nil. When the server received a 0 (zero) or valid Dossier ID, and all its criteria listed above are met, (and the Dossier is configured in the Dialog Setup, or default dialog is picked), it returns the Dossier property (through the GetDialogResponse-&gt;Dialog elements).

Clients do not worry about server criteria, so they pass 0 (zero) or a valid Dossier ID for any object type, including Dossier objects. Let’s assume that v8 supports Dossier-in-Dossier relations. When a v7 client is talking to a v8 server, the Dossier property will then be shown in the dialog, and will work well.

Let’s assume that for Enterprise 8.0 the CopyTo dialog supports the Dossier property. Any v8 client passes a value for DefaultDossier parameter and the v8 Server returns the Dossier property, which is shown in the dialog. The 8.0 client then passes the chosen Dossier ID (by end user) through the CopyObjects service. But, when a v7 client is talking to a v8 server, the DefaultDossier parameter is set to nil, and *no* Dossier property is shown. And vice versa, when a v8 client is talking to a v7 server, the client passes a value for DefaultDossier parameter, but the server does not return the Dossier property, and so it is not shown in the dialog.

When the user is about to Create a new object, the server resolves and returns the Dossiers to let the user pick one. Even when there are no Dossiers found, the Dossier property is returned. Note that the "New Dossier" item (ID=-1) always exists in the list of Dossiers. This allows users to create a new Dossier, even when there are none found. There is also an empty item (ID=0) which means there is no need to create a Dossier. When a user submits the dialog, the client should pass the Dossier in the object relations (type Contained) of the CreateObjects request. (This should be done for ID &lt;&gt; 0 only.)

The Publication, Issue, Section and State parameters indicate the user’s selection in the workflow dialog. By passing those parameters, clients ask the server how the dialog should be drawn for the given publication/Issue, regardless of the actual publication/issue of the object as stored in the database. So, these parameters are ‘strongest’ and overrule any other sever logics deriving publication/Issue from parent objects, template objects, configured current Issue, etc, etc. Important is that clients pass -no- Publication parameter the ‘first time’. That way, server logics can kick in, but more over, custom server plug-ins can even overrule those logics by choosing specific publication/Issue. The ones that are initially picked by the server can be read from the GetDialogResponse -&gt; Dialog -&gt; MetaData.

The Publication, Section and State parameters imply what access profile is respected. For example, the “Change Pub/Issue/Category” option is resolved and so the properties mentioned are made read-only or editable (by GetDialog service).

The table below shows what combination of parameters are expected. Other combinations are not supported. As you can see, when asked for a Create action, no object ID should be passed, but a Type is required. For other actions, it is the other way around. And, only for redraw operations, Publication, Issue and Section should be passed. Except for creating new objects without Parent/Template; the client should pass a Publication, which should be taken from the context the user is working in. For example: the last used publication, or the publication currently selected in the Search pane.

 **Event**                      | ID      | Type      | PT(2)        | Pub      | Issue           | Section      | Status 
 -------------------------------| --------| ----------| -------------| ---------| --------------- | -------------| ------------
 Action: Create^(1)^ - initial  | ✘       | ✔         | ✘            | ✔        | ✔/✘ **^(4)^**   | ✘            | ✘
 Action: Create^(1)^ - initial  | ✘       | ✔         | ✔            | ✘        | ✘               | ✘            | ✘
 Action: Other - initial        | ✔       | ✘         | ✔            | ✘        | ✘               | ✘            | ✘
 Change: pub/overrule^(3)^      | -       | -         | -            | ✔        | ✔/✘ **^(4)^**   | ✘            | ✘
 Change: issue/sec/stat^(5)^    | -       | -         | -            | ✔        | ✔               | ✔            | ✔

Legend:

✔ = valid ID (not empty, not zero)

✘ = nil

\- = depends on the action (inherited from one of the first three lines above)

1)  For Save As operations, the Action parameter should be set to Create. Note: Although the dialog caption says Check-In, technically we speak of a Create action.
2)  Whether or not a Parent (ID) or Template (ID) was provided. This is used to derive the publication (and overrule Issue) from.
3)  When user selects other Brand or overrule Issue, a GetDialog request is fired and the dialog is redrawn. The entire dialog definition can change, so a full redraw is required.
4)  For overrule Issue: ✔, but for normal Issue: ✘.
5)  When a user selects (normal) Issue, section or status, GetDialog request is fired to let the server reflect access rights profile settings to the dialog fields, and to refill certain lists, such as Dossiers, sections and statuses.

## GetDialogResponse

  **Element structure**  | **Description**
  -----------------------| ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  Dialog                 | Workflow dialog definition.
  ↳ Tabs                 | Defines tabs and widgets to draw. The tab sequence represents the z-order with first the tab on top. For each tab, widgets are listed. The sequence needs to be respected with the first widget on top. For each widget, the usage is defined; whether or not to show read-only, mandatory, etc. When client supports the complex Targets widget, it should combine the Issues and Editions widgets and draw the Targets widget instead. The Targets position should be respected. If the client does not support the Targets widget, it should ignore it and simply draw Issues and Editions widgets.
  ↳ MetaData             | For each widget under the Tabs element, a value is given to pre-fill / pre-select in the dialog.
  Publications           | The Brands (ids and names) for which user has access. Used to populate the Brand pull-down menu.
  PublicationInfo        | The configuration definition of the current Brand. For new objects, this is the requested Brand (through GetDialog -&gt; Publication). For existing objects, this is the object’s Brand.
  ↳ PubChannels          | The Brand’s publication channels, Issues and Editions definitions. Used to populate the Issues and Editions pull-down menus. When requested for an overrule Issue (through GetDialog -&gt; Issue), the corresponding IssueInfo holds its Categories and Editions definitions, which is used to populate the pull-down menu instead.
  ↳ Categories           | The Categories (ids and names) configured on Brand level. Used to populate the Category pull-down menu.
  MetaData               | The current object properties as stored in the database (regardless of the requested Brand/Issue). Used to create or update an object once the dialog is submitted. This way, calling the GetObjects service first is not needed. When requested for a template (GetDialog -&gt; Template) much of the template’s metadata is inherited. Typically used to create a new article from the article template.
  GetStatesResponse      | Statuses, users and user groups to which the object can be sent. Used to populate the Status and Route To pull-down menus.
  Targets                | For existing objects, these are the object targets as stored in the database. Except when a user is switching to/from another Brand or Overrule Issue. In that case, the object targets are replaced with one target to the current Issue of the default channel. For new objects, these are the initial targets derived from the given parent (layout), Dossier, or template. If there are no such derivable objects given, the current Issue of the default channel is the server’s best guess. These targets should be shown (by the clients) when -initially- showing the dialog. And also, when a user has selected another Brand or overrule Issue, clients should clear the currently user built target list shown in the dialog and respect the targets return from the server. But, when a user selects a normal Issue, Category or status, a redraw is required too, in which case the current user targets are preserved (and the returned targets from the server are ignored) by clients.
  RelatedTargets         | The parent’s targets, in case the object is placed and/or Dossier’s relational\* targets in case the object is contained by a Dossier. For example, the layout’s targets in case an article is placed on that layout. There can be zero, one, or many parents/Dossiers involved. A maximum of 5 parents are returned and a maximum of 5 Dossiers. When these limits are exceeded, a dummy item is returned named “...”. \* These are -not- the Dossier’s targets, but the targets set for the contained object within the Dossier (called relational targets).
  Dossiers               | List of Dossiers (ids and names) available within the requested Brand/Issue. Only provided when requested for (GetDialog -&gt; DefaultDossier). Used to populate the Dossiers pull-down menu.

### Exceptional standard dialog behavior

#### Disabling the Editions property

For Task, Hyperlink, Library, Plan and Other objects, Editions are always disabled.

#### Disabling Brand / Issue / Editions property for Layout Module placements

For objects placed on Layout Modules (or Layout Module Templates), the Brand, Issue and Editions properties are disabled. This is because Editions are inherited from the module and are not allowed to change (in order for its placements to preserve data integrity).

#### Disabling Brand / Issue / Editions / Category property for placements

The Create dialogs for Articles and Image objects show disabled Brand, Issue, Editions and Category properties when they are created from a Layout.

#### Disabling Status property and the Personal Status

For existing objects, the Change Status access option is respected, and so you will risk having a disabled Status property. This is correct, except when the Personal status is currently selected. (Reason: no-one else can see the object other than the user to whom the object is routed to, but that user cannot change the status, and so an admin user would need to be asked to solve this problem, which is unwanted.) So, when an object is in the Personal Status, the Status property is enabled.

#### Disabling properties in the Set Properties dialog

When an object is already locked for editing, the Set Properties dialog shows all disabled properties. This is done by the client, not by the server (because InDesign/InCopy clients do pessimistic locking and so in both cases the object is locked and the server cannot tell the difference). This implies that the Server Plug-ins cannot alter the enabled status of the properties in this specific situation.

#### Automatic user input focus

For workflow dialogs, the focus (caret) is set to the Status property. For the Create and Copy To dialogs, or when the Status property is disabled, the focus is set to the Name field.

#### Limited Edition items

When an object is placed on a Layout (or LayoutModule or Layout Template), the Create and Check-In workflow dialogs list limited Editions items: only those Editions that are currently assigned to the Layout.

#### Inactive, but assigned Issues

Inactive Issues are not listed in the workflow dialogs, except for those Issues (and their Editions) that are currently assigned to the object. The user can deselect such inactive Issues (because they are assigned). However, the next time the workflow dialog raises, unassigned Issues that are inactive are no longer listed.

#### ‘Change’ access rights not applied to Create and Copy To dialogs

The Access Profiles Maintenance page contains the following 'Change' access rights options:
* Change Brand/Issue/Category
* Change Edition
* Change Status

By toggling the Brand/Category/Status properties in the Create dialog, because of the access rights mentioned, those properties could 'suddenly' get disabled. There would be no escape from that point. To avoid such deadlocks, the Brand/Issue/Category/Edition/Status properties are enabled for the Create dialog (except in case there are other rules telling to disable the properties, such as Create Article on a Layout Module for which they should be disabled). In short, the Create dialog ignores the 'Change' access options.

#### Property inheritance for Create and Copy To dialogs

When objects are about to be copied, or created from a template or directly created onto a parent layout, properties are inherited (from the source/template/parent object) and pre-filled in the dialog. This is done for all properties, except for the following:
* ID
* Document ID
* Name, Type
* Content Source
* Deadline
* Urgency
* Creator
* Created
* Modifier
* Modified
* Comment
* Status
* Route To
* Locked By
* Version
* Deadline Soft
* Rating

Those properties are cleared, and so empty properties are shown in the dialog. Nevertheless, some of those properties are automatically re-determined, such as: Name, Type, Status, Route To and Version. Those are pre-filled (with possibly a different value than the source object).

## GetDialog2 service \[since 8.0\]

Up to and including v7, InDesign, InCopy and Content Station call the *GetDialog service* each time when user changes a property value (dialog field) for which the ‘Refresh’ flag is enabled. The request contains the new user typed value. That way, a custom server plug-in is able to act on the change.

Since v8, there is a new service, called GetDialog2, which supersedes the GetDialog service. Its request and the response are simplified to make it easier for clients, especially when it comes to refreshing dialogs. Basically it does the same, but instead of separate parameters, structured data trees are round-tripped through MetaData and Targets. This takes away the need to cache user typed data, which is quite complicated to merge on the way back. This makes clients rely even more on the server behavior, which results into more consistent behavior between clients.

At least for the 8.x versions, the GetDialog is still supported to allow clients to migrate to GetDialog2. Clients are encouraged to do so.

This is where clients pick-up data from server to show at dialog:

``` 
GetDialog2Response
	Dialog
		...
		MetaData
			MetaDataValue
	...
	Targets
		Target
```

When redrawing the dialog, the user typed data is round-tripped through the new parameters as follows:

``` 
GetDialog2
	...
	MetaData
		MetaDataValue
	Targets
		Target
```

For client convenience, the MetaData tree is not used (with BasicMetaData, etc), but instead, the list structure is used (with MetaDataValue). Custom properties are supported and are prefixed with “C\_”.

In v7, the following properties are round-tripped through a fixed set of GetDialog service parameters:

``` 
GetDialog
	...
	ID
	Publication
	Issue
	Category
	Status
	Type
	...
```

There is one exceptional field; The RouteTo field should respect the Brand’s Routing configuration which is taken care of by the core server. The round-trips caused by the Refresh fields should not disturb this existing feature.

To optimize data traffic and server-side execution speed, clients can request for less data, in case they don’t need that much. In v7, this is done as follows:

```xml
<GetDialog>
	...
	<RequestDialog>true</RequestDialog>
	<RequestPublication>true</RequestPublication>
	<RequestMetaData>true</RequestMetaData>
	<RequestStates>true</RequestStates>
	<RequestTargets>true</RequestTargets>
	...
```
and as a result, the following data structure is filled in (or not):

``` 
GetDialogResponse
	Dialog
	Publications
	PublicationInfo
	MetaData
	GetStatesResponse
	Targets
	RelatedTargets
	Dossiers
```
Since v8, the response structure has changed into this:

``` 
GetDialog2Response
	MetaData
	Targets
	RelatedTargets
```

As you can see, there are much less data elements returned, since that data is now moved to the MetaDataValue structure with id-name pairs. And so, there is no longer need to have filtering parameters, which are therefore not present at the GetDialog2 request.

### Show display names for internal values \[since 8.0\]

For configured data structures, such as Brands, Issues, etc, the client and server communicate DB ids, while showing display names to end users. To do such, both sides need to know about the configured data structures, which is very dedicated and therefore limited to built-in (known) properties. In v7, there is no common structure that can hold both internal values and display names. With v8 there is, and so custom properties can use those, but also the built-in properties can be expressed in a more common way. This takes out some client logics, which makes things less dependent and specific.

The structure that holds the values, is defined as follows, whereby v8 changes are in bold:

```xml
<complexType name="MetaDataValue">
	<all>
		<element name="Property" type="xsd:string"/>
		<element name="Values" type="tns:ArrayOfString"
			minOccurs="0" maxOccurs="1"/>
		<element name="PropertyValues"
			type="tns:ArrayOfPropertyValue”
			minOccurs="0" maxOccurs="1"/>
	</all>
</complexType>
```

The following definitions are added since v8 as well:

```xml
<complexType name="PropertyValue">
	<all>
		<element name="Value" type="xsd:string"/>
		<element name="Display" type="xsd:string" 
			minOccurs="0" maxOccurs="1"/> <!-- optional -->
	</all>
</complexType>
<complexType name="ArrayOfPropertyValue">
	<complexContent>
		<restriction base="soap-enc:Array">
			<attribute ref="soap-enc:arrayType"
			wsdl:arrayType="tns:PropertyValue[]"/>
		</restriction>
	</complexContent>
</complexType>
```

v7 example of usage, which is dis-encouraged:

```xml
<MetaDataValue>
	<Property>Publication</Property>
	<Values>
		<String>1</String>
	</Values>
</MetaDataValue>
```

v8 example of usage:

```xml
<MetaDataValue>
	<Property>Publication</Property>
	<PropertyValues>
		<PropertyValue>
			<Value>1</Value>
			<Display>WW News</Display>
		</PropertyValue>
	</PropertyValues>
</MetaDataValue>
```

Sending values and display names (like above) are applied to Publications, PubChannels, Issues, Categories, Editions, Users and UserGroups.

### Refresh dialog fields \[since 8.0\]

Workflow dialogs guide users through their workflow. Even though dialogs are already made very flexible, Enterprise 8 takes another step; It enables application engineers to redraw the dialog in specific cases for which some fields needs to be ‘refreshed’.

For example, a customer might wish that, when an end-user tags a checkbox ‘Department’ on a workflow dialog, the listed items at the Route To field gets filtered automatically, showing only the users and groups working for the same department as the current user.

Or the other way around, when the Route To field is changed by the end user, the customer might want to have a readonly ‘Department’ text field to be filled in automatically, with the value configured for the selected user.

There could also be a need to let one field depend on two others, and those fields do not necessarily have to be custom. For example, when the Issue field is set to a print channel and the Edition is set to ‘north’ only, the customer might wish to enter a simplified workflow and so less statuses needs to be shown at the Status field.

The triggers can be both ways, or relate one-to-many and/or custom fields or built-in fields can be involved. The rules and dependencies can be developed through a custom server plug-in. Admin users can not interfere with such complicated rules other than enabling or disabling the whole feature through the Server Plug-ins admin page.

A new flag added to the workflow WSDL, named ‘Refresh’:

```xml
<complexType name="PropertyUsage">
	<all>
		<element name="Name" type="xsd:string"/>
		<element name="Editable" type="xsd:boolean"/>
		<element name="Mandatory" type="xsd:boolean"/>
		<element name="Restricted" type="xsd:boolean"/>
		<element name="Refresh" type="xsd:boolean"/>
	</all>
</complexType>
```

This indicates that when the field is changed by the end-user, the GetDialog service needs to be called by client applications to redraw the dialog. The core server sets this flag for the Brand, overrule Issue and Status fields, which represents the current behavior.

### Multiple objects support \[since 9.2\]

Since Enterprise 9.2, a new parameter 'MultipleObjects' is added to the request. This boolean field can be used to specify whether the dialog is being drawn for a single object (false or nil) or for multiple objects (true).

For backwards compatibility with older clients, the parameter is optional. A request without this parameter is interpreted as a Set Properties operation for a single object.

Based on the parameter value, advanced business rules may apply when determining the dialog options, only returning those properties that apply when handling multiple objects.
