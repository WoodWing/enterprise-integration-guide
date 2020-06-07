---
layout: chapter
title: Annotations [since 8.0]
sortid: 160
permalink: 1042-annotations
---

This chapter describes how the workflow interface/web services definition (SCEnterprise.wsdl) is extended to support the 
Annotations feature.

Unlike other workflow services, the SendMessages service ‘does it all’. Where other services are very explicit (create, 
update, delete), this service looks at the given Message elements and determines what operation to perform (create, 
update, delete) one by one. When a message exists, it does an update, else a create. When the UserID and ObjectID (of a 
Message element) are set to zero, a delete operation is performed instead. In fact, the list of passed in Message elements 
can be seen as a list of commands. This have been the case from the early days of Enterprise, and remains unchanged. 
Nevertheless, this principle is good to understand before reading this chapter. Since 8.0 the delete operations are made 
more explicit to distinguish between users deleting messages, and messages marked as ‘read’ (which is explained in the 
next chapters).

It is by design that placing Sticky Notes on layouts in InDesign are not directly reflected to other users (such as in 
the Publication Overview in Content Station) until the layout is saved. The other way around, when messaging (n-casting) 
is enabled, and users edit Sticky Notes (or replies) in the Publication Overview, those changes -are- reflected directly 
to the layout opened in InDesign. InDesign is responsible for handing conflicts related to Sticky Notes and replies.

## Configuration

**Access rights**

On the Profile Maintenance page, the “Edit Sticky Notes” option in the Workflow section has been renamed in Enterprise Server 8.0 
to “Create and Reply Sticky Notes” and moved to a new section named “Annotations”. Two more access rights are added to 
that section as well: “View Sticky Notes” and “Delete Sticky Notes”.

When the “Edit Sticky Notes” was enabled (or disabled) for older Enterprise Server versions, once migrated to Enterprise Server 8.0, 
“Create and Reply Sticky Notes” and “Delete Sticky Notes” are automatically set accordingly. The “View Sticky Notes” is 
always enabled.

For newly created profiles, all three access right options under the “Annotations” section are enabled by default.

**Important:** Access rights are checked client side, not server side. Whether certain operations are allowed or not is 
made clear to end-users immediately instead of for example after an expensive save operation of a layout. In other terms, 
the web services allow all message operations, as requested by clients. As a result, users working with Smart Connection 7.x 
or Content Station 7.x are allowed to delete message, while Smart Connection 8.0 / Content Station 8.0 could disallow 
(depending on the configured access rights). This behavior is by design.

**Unread messages in Search results**

On the Dialog Setup admin page a new column is added named Unread Messages (UnreadMessageCount). This can be added to 
any of the Query Result Columns. Once configured, it shows the number of Sticky Notes (including replies) that are 
placed on a layout which aren’t read by anyone yet. (This also includes system messages sent to objects.)

Similar to “PlacedOn” and “Issues”, the new property “UnreadMessageCount” is a calculated property. This means that its 
value can only be determined after the object is retrieved from the database. The consequence is that you cannot search/sort 
on this property without use of Solr. In case of Solr, searching and sorting is possible as the value of “UnreadMessageCount” 
is indexed by Solr.

The user creating Sticky Notes or replies does see them counted as unread messages in the search results too, like 
anyone else. This is expected behavior: it should be seen as a mark for new messages added to the workflow that needs 
someones attention when working on those objects.

For the Inbox search, users can simply add the Unread Messages column through the GUI of Smart Connection or Content Station: 
by right-clicking the column header and selecting the column.

**Messages in email**

See the Admin Guide for how to set up and configure email for Enterprise. The enterprise/config/templates folder contains 
email HTML files. In any of the email template files, you can add the %Messages% tag, which gets replaced by the messages 
placed on the layout. For example, when a layout is routed to a user, that user will receive an email where the 
Sticky Notes (and its replies) are already listed in the email.

## Message restructuring \[since 8.0\]

Since 8.0 a new type is introduced, named ‘MessageList’:

```xml
<complexType name="MessageList">
    <all>
        <element name="Messages" type="tns:ArrayOfMessage" 
			nillable="true" />
        <element name="ReadMessageIDs" type="tns:ArrayOfString" 
			nillable="true" />
        <element name="DeleteMessageIDs" type="tns:ArrayOfString" 
			nillable="true" />
    </all>
</complexType>
```

Basically, all Messages- and ReadMessageIDs properties are replaced with MessageList properties. This affects 
LogOnResponse, LogOff request, UnlockObjects request, Object, CreateObjects request, SaveObjects request, ObjectPageInfo 
request, SendMessages request,

And, the meaning of ReadMessageIDs has been changed; It no longer means to delete the messages. Instead, there is a new 
property introduced, named DeleteMessageIDs that does actual deletions. When messages are read by a user, the 
ReadMessageIDs is used. This is for 8.0 clients talking to a 8.0 server. When 7.x clients are talking, the 8.0 will detect 
and change the request on-the-fly in its service layer.

**Server Plug-ins: Migration to 8.0 (or newer)**

Because the service layer in Enterprise Server takes care of restructuring messages on-the-fly, Server Plug-ins (as well 
as the core server) do not have to deal with old structures: there is only the new structure to deal with. Nevertheless, 
this means that old plug-ins needs to be migrated when they intercept the messages.

## User messages

Unlike other message types, messages sent to users are delete once read.

**SC/CS 7.x (or older)**

A user logs in to the system:

```xml
<LogOnResponse>
	...
	<Messages>
		<Message>
			<ObjectID xsi:nil="true" />
			<UserID>woodwing</UserID>
			<MessageID>8547...DD310</MessageID>
			<MessageType>user</MessageType>
			...
		</Message>
	</Messages>
	...
</LogOnResponse>
```

A user has read the message and logs off:

```xml
<LogOff>
	...
	<ReadMessageIDs>
		<String>8547...DD310</String>
	</ReadMessageIDs>
	...
</LogOff>
```

Note that the ReadMessageIDs indicate that the messages needs to be deleted. Since 8.0 this request is made more explicit, 
as explained in the next paragraph.

**SC/CS 8.0 (or newer)**

A user logs in to the system:

```xml
<LogOnResponse>
	...
	<MessageList>
		...
		<Messages>
			<Message>
				<ObjectID xsi:nil="true" />
				<UserID>woodwing</UserID>
				<MessageID>8547...DD310</MessageID>
				<MessageType>user</MessageType>
				...
			</Message>
		</Messages>
		...
	</MessageList>
	...
</LogOnResponse>
```

A user has read the message and logs off:

```xml
<LogOff>
	...
	<MessageList>
		...
		<DeleteMessageIDs>
			<String>8547...DD310</String>
		</DeleteMessageIDs>
		...
	</MessageList>
	...
</LogOff>
```

Note that for the LogOnResponse, the Server detects the client major version in the ClientAppVersion parameter of the 
LogOn request. When this version is 8 (or newer), the MessageList structure is used. When the version is 7 (or older), 
the obsoleted Messages structure is used instead.

# Sticky Notes \[since 4.2\]

Since Enterprise Server 4.2 a new message type is introduced, named ‘sticky’:

```xml
<simpleType name="MessageType">
    <restriction base="string">
        <enumeration value="system" />
        <enumeration value="client" />
        <enumeration value="user" />
        <enumeration value="sticky" />
        <enumeration value="reply" />
    </restriction>
</simpleType>
```

And, the Message is extended with a property named ‘StickyInfo’:

```xml
<complexType name="Message">
    <all>
        <element name="ObjectID" nillable="true" type="xsd:string" />
        <element name="UserID" nillable="true" type="xsd:string" />
        <element name="MessageID" nillable="true" type="xsd:string" />
        ...
        <element name="StickyInfo" nillable="true" type="tns:StickyInfo" />
        ...
    </all>
</complexType>
```

Also, the StickyInfo type definition is introduced:

```xml
<complexType name="StickyInfo">
    <all>
        <element name="AnchorX" type="xsd:double" />
        <element name="AnchorY" type="xsd:double" />
        <element name="Left" type="xsd:double" />
        <element name="Top" type="xsd:double" />
        <element name="Width" type="xsd:double" />
        <element name="Height" type="xsd:double" />
        <element name="Page" type="xsd:unsignedInt"
			nillable="true" minOccurs="0" maxOccurs="1" />
        <element name="Version" type="xsd:string" />
        <element name="Color" type="tns:Color" />
        <element name="PageSequence" type="xsd:unsignedInt" />
    </all>
</complexType>
```

**Smart Connection: Place new Sticky Note on a page**

_**Smart Connection 7.x (or older)**_

In InDesign (or InCopy), the user places a Sticky Note on a page and saves the layout:

```xml
<SaveObjects>
	...
	<Messages>
		<Message>
			<ObjectID>27</ObjectID>
			<UserID xsi:nil="true" />
			<MessageID>8547...DD310</MessageID>
			<MessageType>sticky</MessageType>
			<MessageTypeDetail></MessageTypeDetail>
			<Message>The text does not fit here.</Message>
			<TimeStamp>2012-03-13T17:40:14</TimeStamp>
			<Expiration xsi:nil="true" />
			<MessageLevel xsi:nil="true" />
			<FromUser>woodwing</FromUser>
			<StickyInfo>
				<AnchorX>43.022093</AnchorX>
				<AnchorY>177.920463</AnchorY>
				<Left>61.046512</Left>
				<Top>155.247207</Top>
				<Width>181.000000</Width>
				<Height>78.000000</Height>
				<Page>1</Page>
				<Version>0</Version>
				<Color>FF0000</Color>
				<PageSequence>1</PageSequence>
			</StickyInfo>
		</Message>
	</Messages>
	...
</SaveObjects>
```

**_Smart Connection 8.0 (or newer)_**

In InDesign (or InCopy), the user places a Sticky Note on a page and saves the layout:

```xml
<SaveObjects>
	...
	<Objects>
	<Object>
		...
		<MessageList>
			...
			<Messages>
			<Message>
				<ObjectID>27</ObjectID>
				<UserID xsi:nil="true" />
				<MessageID>8547...DD310</MessageID>
				<MessageType>sticky</MessageType>
				<MessageTypeDetail></MessageTypeDetail>
				<Message>The text does not fit here.</Message>
				<TimeStamp>2012-03-13T17:40:14</TimeStamp>
				<Expiration xsi:nil="true" />
				<MessageLevel xsi:nil="true" />
				<FromUser>woodwing</FromUser>
				<StickyInfo>
					<AnchorX>43.022093</AnchorX>
					<AnchorY>177.920463</AnchorY>
					<Left>61.046512</Left>
					<Top>155.247207</Top>
					<Width>181.000000</Width>
					<Height>78.000000</Height>
					<Page>1</Page>
					<Version>0</Version>
					<Color>FF0000</Color>
					<PageSequence>1</PageSequence>
				</StickyInfo>
				<ThreadMessageID xsi:nil="true" />
				<ReplyToMessageID xsi:nil="true" />
				<MessageStatus>None</MessageStatus>
			</Message>
			</Messages>
			...
		</MessageList>
		...
	</Object>
	</Objects>
	...
</SaveObjects>
```

Same for CreateObjects request.

**Content Station: Place a new Sticky Note on a page**

**_Content Station 7.x (or older)_**

On the Publication Overview, the user places a Sticky Note on a page:

```xml
<SendMessages>
	...
	<Messages>
		<Message>
			<ObjectID>10</ObjectID>
			<UserID xsi:nil="true" />
			<MessageID></MessageID>
			<MessageType>sticky</MessageType>
			<MessageTypeDetail></MessageTypeDetail>
			<Message>The text does not fit here.</Message>
			<TimeStamp>2012-03-16T12:48:46</TimeStamp>
			<Expiration xsi:nil="true" />
			<MessageLevel xsi:nil="true" />
			<FromUser>woodwing</FromUser>
			<StickyInfo>
				<AnchorX>0</AnchorX>
				<AnchorY>0</AnchorY>
				<Left>163</Left>
				<Top>216</Top>
				<Width>300</Width>
				<Height>100</Height>
				<Page>0</Page>
				<Version>0</Version>
				<Color>ff0000</Color>
				<PageSequence>1</PageSequence>
			</StickyInfo>
		</Message>
	</Messages>
</SendMessages>
```

**_Content Station 8.0 (or newer)_**

On the Publication Overview, the user places a Sticky Note on a page:

```xml
<SendMessages>
	...
	<MessageList>
		...
		<Messages>
			<Message>
				<ObjectID>10</ObjectID>
				<UserID xsi:nil="true" />
				<MessageID></MessageID>
				<MessageType>sticky</MessageType>
				<MessageTypeDetail></MessageTypeDetail>
				<Message>The text does not fit here.</Message>
				<TimeStamp>2012-03-16T12:48:46</TimeStamp>
				<Expiration xsi:nil="true" />
				<MessageLevel xsi:nil="true" />
				<FromUser>woodwing</FromUser>
				<StickyInfo>
					<AnchorX>0</AnchorX>
					<AnchorY>0</AnchorY>
					<Left>163</Left>
					<Top>216</Top>
					<Width>300</Width>
						<Height>100</Height>
					<Page>0</Page>
					<Version>0</Version>
					<Color>ff0000</Color>
					<PageSequence>1</PageSequence>
				</StickyInfo>
				<ThreadMessageID xsi:nil="true" />
				<ReplyToMessageID xsi:nil="true" />
				<MessageStatus>None</MessageStatus>
			</Message>
		</Messages>
		...
	</MessageList>
	...
</SendMessages>
```

## Reply to a message \[since 8.0\]

Since Enterprise Server 8.0, a new message type is introduced, named ‘reply’:

```xml
<simpleType name="MessageType">
    <restriction base="string">
        <enumeration value="system" />
        <enumeration value="client" />
        <enumeration value="user" />
        <enumeration value="sticky" />
        <enumeration value="reply" />
    </restriction>
</simpleType>
```

And, the Message is extended with two properties, named ‘ThreadMessageID’ and ‘ReplyToMessageID’:

```xml
<complexType name="Message">
    <all>
        <element name="ObjectID" nillable="true" type="xsd:string" />
        <element name="UserID" nillable="true" type="xsd:string" />
        <element name="MessageID" nillable="true" type="xsd:string" />
        ...
        <element name="ThreadMessageID" type="xsd:string" 
			nillable="true" minOccurs="0" maxOccurs="1" />
        <element name="ReplyToMessageID" type="xsd:string"
			nillable="true" minOccurs="0" maxOccurs="1" />
        ...
    </all>
</complexType>
```

Note that ThreadMessageID and ReplyToMessageID are made optional to support 7.6 clients talking to a 8.0 server. In 
future versions this might become mandatory (but remains nillable).

Although hierarchy in message replies is not required for 8.0, the data model is prepared for this future feature. For 
the GUI, a flat list can be shown, and in future versions, this can be made more advanced by showing a hierarchy.

Once a Sticky Note is placed, users can reply. The Sticky Note can be seen as the initiator of a ‘thread’. The sticky 
message has StickyInfo, but the replies don’t (set to nil). The sticky message has ReplyToMessageID set to zero, but 
replies have set it to the message ID of the previous reply or sticky. The sticky message and the replies have the 
ThreadID set to the sticky message ID.

**Smart Connection: Reply to a Sticky Note on a page**

In InDesign (or InCopy), the user replies at a Sticky Note on a page and saves the layout:

```xml
<SaveObjects>
	...
	<Objects>
	<Object>
		<MessageList>
			...
			<Messages>
			<Message>
				<ObjectID>27</ObjectID>
				<UserID xsi:nil="true" />
				<MessageID>6EFE668F-...-4823E18B9EBF</MessageID>
				<MessageType>reply</MessageType>
				<MessageTypeDetail></MessageTypeDetail>
				<Message>I have made the text fit now.</Message>
				<TimeStamp>2012-03-14T12:45:00</TimeStamp>
				<Expiration xsi:nil="true" />
				<MessageLevel xsi:nil="true" />
				<FromUser>woodwing</FromUser>
				<StickyInfo xsi:nil="true" />
				<ThreadMessageID>8547...DD310</ThreadMessageID>
				<ReplyToMessageID>8547...DD310</ReplyToMessageID>
				<MessageStatus>None</MessageStatus>
			</Message>
			</Messages>
			...
		</MessageList>
	</Object>
	</Objects>
	...
</SaveObjects> 
```

Note that messages are hierarchical. The ThreadMessageID points to the initial Sticky Note. The ReplyToMessageID points 
to the message the user reacts on. For the first reply, these two ids are the same. For following replies the ThreadMessageID 
remains the same, but ReplyToMessageID could point to the Sticky Note or any of the replies. The request is composed in human 
reading order to simplify parsing it server side (by core or plug-ins), and so it may assumed that the two ids always 
refer back to messages listed ‘earlier’.

**Content Station: Reply to a Sticky Note on a page**

In the Publication Overview, the user replies to a Sticky Note on a page:

```xml
<SendMessages>
	...
	<MessageList>
		...
		<Messages>
			...
			<Message>
				<ObjectID xsi:nil="true" />
				<UserID xsi:nil="true" />
				<MessageID>6EFE668F-41ED-A226-4823E18B9EBF</MessageID>
				<MessageType>reply</MessageType>
				<MessageTypeDetail></MessageTypeDetail>
				<Message>I have made the text fit now.</Message>
				<TimeStamp>2012-03-14T12:45:00</TimeStamp>
				<Expiration xsi:nil="true" />
				<MessageLevel xsi:nil="true" />
				<FromUser>woodwing</FromUser>
				<StickyInfo xsi:nil="true" />
				<ThreadMessageID>8547...DD310</ThreadMessageID>
				<ReplyToMessageID>8547...DD310</ReplyToMessageID>
				<MessageStatus>None</MessageStatus>
			</Message>
			...
		</Messages>
		...
	</MessageList>
	...
</SendMessages>
```

**Modify a Sticky Note (since 4.2) or a reply \[since 8.0\]**

In InDesign (or InCopy) and/or in the Publication Overview of Content Station, when a user changes the text on their own 
replies the same request is sent as during the creation (except that the data is updated). The same happens when a user 
moves the Sticky Note or its anchor.

Note that this is only allowed when there are no replies to the message being modified. In other terms, if another user 
has replied in the meantime, the message can no longer be modified. The server throws an error on such an attempt but 
only for SendMessages service (called by Content Station).

The last update / operation for a message ‘wins’. So when user A updates all messages on a page, just after user B has 
updated his/her own message, the update of user A overwrites the update of user B. This was for 7.x (or older) a bigger 
problem than for 8.0 (or newer) since users are only allowed to update their own messages. Nevertheless, Smart Connection 
and Content Station therefore never send messages of other users, other than the messages of the current user. And, they 
only send messages that are really updated. Untouched messages are never sent to the server. Also, when sending messages, 
their properties are set to nil as much as possible (but, obviously respecting the WSDL) to avoid undoing earlier made changes.

**Delete a Sticky Note (since 4.2) or a reply \[since 8.0\]**

**_Smart Connection 7.x (or older)_**

In InDesign (or InCopy), the user deletes a Sticky Note or reply:

```xml
<SaveObjects>
	...
	<ReadMessageIDs>
		<String/>8547...DD310</String>
	</ReadMessageIDs>
	...
</SaveObjects>
```

Note that the ReadMessageIDs indicate that the messages needs to be deleted. Since 8.0 this request is made more explicit 
as written in next paragraph.

_**Smart Connection 8.0 (or newer)**_

In InDesign (or InCopy), the user deletes a Sticky Note or reply:

```xml
<SaveObjects>
	...
	<Objects>
		<Object>
			...
			<MessageList>
				...
				<DeleteMessageIDs>
					<String/>8547...DD310</String>
				</DeleteMessageIDs>
				...
			</MessageList>
			...
		</Object>
	</Objects>
	...
</SaveObjects>
```

**_Content Station 7.x (or older)_**

In the Publication Overview, the user deletes a Sticky Note or reply:

```xml
<SendMessages>
	...
	<Messages>
		<Message>
			<ObjectID>0</ObjectID>
			<UserID>0</UserID>
			<MessageID>8547...DD310</MessageID>
			<MessageType>sticky</MessageType>
			...
		</Message>
	</Messages>
</SendMessages>
```

Note that when both ObjectID and UserID are set to zero, the message gets deleted (from the database). Since 8.0 this 
request is made more explicit as written in next paragraph.

**_Content Station 8.0 (or newer)_**

In the Publication Overview, the user deletes a Sticky Note or reply:

```xml
<SendMessages>
	...
	<MessageList>
		...
		<DeleteMessageIDs>
			<String/>8547...DD310</String>
		</DeleteMessageIDs>
		...
	</MessageList>
</SendMessages>
```

**_Server Plug-ins: Migration to Enterprise Server 8.0 (or newer)_**

Custom server plug-ins designed for Enterprise Server 7.x (or older) that implement the SendMessages connector to detect message 
deletions need to be migrated to the 8.0 method. The service layer transforms old service requests into new service 
requests, so the connectors will be called in the 8.0 way, regardless of how it gets called by clients.

**_Exceptions_**

Note that deleting replies is only allowed when there are no other replies to it. In other terms, if another user has 
replied in the meantime, the message can no longer be deleted. The server throws an error on such attempt for SendMessages 
(Content Station), but not for SaveObjects (Smart Connection).

## Mark as read \[since 8.0\]

**Smart Connection: Mark a Sticky Note (or a reply) as read**

In InDesign (or InCopy), the user opens a layout that contains a Sticky Note:

```xml
<GetObjectsResponse>
	...
	<Objects>
	<Object>
		...
		<MessageList>
			...
			<Messages>
			<Message>
				<ObjectID>27</ObjectID>
				<UserID xsi:nil="true" />
				<MessageID>8547...DD310</MessageID>
				<MessageType>sticky</MessageType>
				...
			</Message>
			</Messages>
			<ReadMessageIDs></ReadMessageIDs>
			...
		</MessageList>
		...
	</Object>
	</Objects>
	...
</GetObjectsResponse>
```

> Note that for the GetObjectsResponse, the Server detects the client major version in the ClientAppVersion parameter 
of the LogOn request. When this version is 8 (or newer), the MessageList structure is used. When the version is 7 (or older), 
the obsoleted Messages structure is used instead.

In InDesign (or InCopy), the user marks a reply (to a Sticky Note on a page) as ‘read’ and saves the layout:

```xml
<SaveObjects>
	...
	<Objects>
		<Object>
			...
			<MessageList>
				...
				<ReadMessageIDs>
					<String/>8547...DD310</String>
				</ReadMessageIDs>
				...
			</MessageList>
			...
		</Object>
	</Objects>
	...
</SaveObjects>
```

**Content Station: Mark Sticky Note (or a reply) as read**

In the Publication Overview, the user opens a preview that contains Sticky Notes and marks a Sticky Note as ‘read’:

```xml
<SendMessages>
	...
	<MessageList>
		...
		<ReadMessageIDs>
			<String/>8547...DD310</String>
		</ReadMessageIDs>
		...
	</MessageList>
</SendMessages>
```

## Message workflow \[since 8.0\]

To implement a basic workflow for messages, the Message is extended with MessageStatus:

```xml
<complexType name="Message">
    <all>
        <element name="ObjectID" nillable="true" type="xsd:string" />
        <element name="UserID" nillable="true" type="xsd:string" />
        <element name="MessageID" nillable="true" type="xsd:string" />
        ...
        <element name="MessageStatus" type="tns:MessageStatus"
	         nillable="true" minOccurs="0" maxOccurs="1"/>
        ...
    </all>
</complexType>
```

Note that the MessageStatus is made optional to support 7.6 clients talking to a 8.0 server.

The message can follow these statuses:

```xml
<simpleType name="MessageStatus">
    <restriction base="string">
        <enumeration value="None" />
        <enumeration value="Accepted" />
        <enumeration value="Cancelled" />
        <enumeration value="Completed" />
        <enumeration value="Rejected" />
    </restriction>
</simpleType> 
```

Note that message statuses are pre-defined and cannot be customized.

## History trail for Sticky Notes and replies \[since 8.0\]

To track for which object version a message was created, the Message is extended with ObjectVersion:

```xml
<complexType name="Message">
    <all>
        <element name="ObjectID" nillable="true" type="xsd:string" />
        <element name="UserID" nillable="true" type="xsd:string" />
        <element name="MessageID" nillable="true" type="xsd:string" />
        ...
        <element name="ObjectVersion" type="xsd:string"
	         nillable="true" minOccurs="0" maxOccurs="1"/>
        ...
    </all>
</complexType>
```

To allow 7.6 clients talking to a 8.0 server, the ObjectVersion property is made optional. 7.6 clients send no 
ObjectVersion, but 8.0 client send an ObjectVersion set to nil. The reason is that for a future version this property 
will be made mandatory (but remains nillable).

When a Message is sent along with the CreateObjects or SaveObjects requests (fired by Smart Connection), the 
ObjectVersion is nil to let the Server determine and fill-in the created object version just before storing the message 
in the database. When a Message sent along the SendMessages request (fired by Publication Overview), the ObjectVersion 
is pre-filled by Content Station. The reason is that the user intension is to put the Sticky Note on the particular 
version he/she is looking at. So the version in known ahead of the operation.

## Implicit deletion of Sticky Notes and replies

Some cases exist whereby Sticky Notes and replies are deleted implicitly.

**On deletion of an object**

When an object is sent to the Trash Can, nothing happens to the Sticky Notes nor their replies. But when the object gets 
removed from Trash Can (purged), they all get removed too.

**On deletion of a user**

This hardly happens, but the system administrator can remove a user (although it is a preferred method to de-activate 
users instead). Sticky Notes and their replies will -not- be removed from the layout pages implicitly. But, messages sent 
to the user that is removed, are removed implicitly. Basically, messages can be sent from a user who does no longer exist 
in the system. But for messages sent to a user, that user must exist. For all the above, the same counts for user groups.

**On deletion of a Sticky Note**

Deleting a Sticky Note implicitly deletes all its replies.

**Planning integration**

3rd-party planning systems (such as Journal Designer) connect through the planning interface (SmartEditorialPlan.wsdl), 
just like the clientplan.php tool (in the wwtest folder). Doing so, the Server sends messages to the layouts and adverts 
that are created or modified. Those messages are shown in a dialog in InDesign when opening the layout (for example with 
placed adverts). Those messages have the MessageType set to ‘system’ and MessageTypeDetail set to the operation, such as 
‘ModifyLayout’.

## Exceptions

The SendMessages service (as called by Content Station) can throw various types of errors. There are all kinds of 
exceptional situations that can occur in production:

* User A could purge a layout while user B is replying to a Sticky Note on one of the pages.
* User A modifies his/her last reply while user B is replying to it.
* ...

The SaveObjects service (as called by Smart Connection) does -not- throw errors for message related problems. This is 
to avoid failures on expensive save operations (especially for layouts). Nevertheless, erratic messages are skipped 
to make sure all messages are at least handled.

## Access rights

The access rights listed in the table below are related to annotations: The actual values configured on the admin pages 
are returned through LogOn web service and are checked client side.

  **access right**                 | **internal name**  | **introduced since**  | **default value**
  ---------------------------------| -------------------| ----------------------| -------------------
  Create and Reply Sticky Notes\*  | EditStickyNotes    | 4.2                   | enabled
  View Sticky Notes                | ViewNotes          | 8.0                   | enabled
  Delete Sticky Notes              | DeleteNotes        | 8.0                   | enabled

> \* Since 8.0, the access right “Edit Sticky Notes” is renamed to “Create and Reply Sticky Notes”, as shown on the 
Profiles Maintenance admin page. However, the internal name (communicated from server to clients) still remains the 
same, which is “EditStickyNotes”. This is done for backwards compatibility reasons (version 7 client talking to version 
8 server).

Through the LogOnResponse, only differences compared to the default values are sent to clients. In other terms, when 
admin user did not change the default, nothing is sent. Since all three access rights options enabled by default, when 
the admin user disables one of these options, only those are returned.

For example, when all three options are disabled by the admin user, the following is returned:

```xml
<LogOnResponse>
	...
	<FeatureProfiles>
		...
		<FeatureProfile>
		    <Name>My Profile</Name>
		    <Features>
		        ...
		        <AppFeature>
		            <Name>ViewNotes</Name>
		            <Value>No</Value>
		        </AppFeature>
		        <AppFeature>
		            <Name>EditStickyNotes</Name>
		            <Value>No</Value>
		        </AppFeature>
		        <AppFeature>
		            <Name>DeleteNotes</Name>
		            <Value>No</Value>
		        </AppFeature>
		        ...
		    </Features>
		</FeatureProfile>
		...
	</FeatureProfiles>
	...
</LogOnResponse>
```

## n-cast messaging

With n-casting (broadcasting / multicasting) enabled, changes to messages are directly reflected between the InDesign 
layout and the Publication Overview. This is convenient, but also avoids data loss. It is expected that when user A saves 
a layout, after user B has made changes to Sticky Notes in the Publication Overview, that the changes of user A overwrite 
the changes of user B. Chances that such a thing happens are slim when n-casting is enabled. Obviously, for remote workers 
this cannot be enabled, and so chances are relatively bigger.

The Messaging Specification gives full detail of n-casted messages and their fields. Since 8.0, the following fields are 
added to the SendMessage event: ThreadMessageID, ReplyToMessageID, MessageStatus, ObjectVersion and IsRead (boolean).
