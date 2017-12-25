---
layout: chapter
title: Messages
sortid: 70
permalink: doc1031
---
Web Services are initiated by clients and executed by the server. But there is more. Halfway a service execution, the server can fire a message. It does this for all kind of events. The messages are pushed to any of the clients that are listening.

The messaging system of Enterprise is built on network broadcasting or multicasting. That works for LAN only. Since Enterprise 10.0 there is a message queue integration with RabbitMQ that allows messages to travel over WAN.

This chapter describes the format of all messages sent by Enterprise Server. This is typically useful when you develop you own client application and you want to receive and interpret such messages.

Note that the Enterprise client applications do exactly the same, implementing the following Enterprise features:
- Hot Inbox
- User Messaging
- Live Update

## Message format for broadcasting / multicasting

A message is always related to a single object (or user). They consist of a header followed by multiple data fields (properties). The following format is respected:
![](images/image17.png)

The following table describes the tokens used in the picture:

|  **token**     | **type**     | **description**
|  --------------| -------------| ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|  format        | uint8        | Version number of this format, which might change in the future. Should be set to 1
|                |              | which is the current version.
|  event         | uint8        | Identifier of message type. Implies which fields are listed. See next chapter.
|                | uint8        | Type of message. 1 = Server/System. 2 = Client/App. 3 = User.
|  reserved      | uint8        | Reserved for future purposes.
|  field id len  | uint16       | Length in bytes of (escaped) field identifier. Integer respects Big Endian notation.
|  field id      | UTF8 string  | Unicode string in UTF-8 notation. Contains the value of the field identifier. These IDs should match field names returned from database queries. Therefore, a new element is introduced in the Property element of WSDL to make difference between localized and unlocalized property names. If the field ID matches one of the Name elements, its value is updated.
|  value len     | uint16       | Length in bytes of (escaped) field value. Integer respects Big Endian notation.
|  value         | UTF8 string  | Unicode string in UTF-8 notation. Contains the value of the field value. All types of fields are transformed to string notation

Because messages are broadcasted, the total package size of a single message should NOT exceed the ethernet frame size, typically 1500 bytes. If fields don’t fit in a message, they are ignored and the message is sent without them

## Events

The following shows all supported events and their messages:

|  **ID**  | **Action**                       | **Since**  | **Fields**
|  --------| ---------------------------------| -----------| ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|  1       | Logon                            |            | Ticket 9), UserID, FullName (user), Server (name)
|  2       | Logoff                           |            | Ticket 9), UserID
|  3       | CreateObject 3)                |            | Ticket 9), ID (object), Type (object) 1), Name (object), PublicationId, IssueIds, EditionIds, SectionId, StateId, Modified, Modifier, RouteTo (user), LockedBy (user), Version (object), Format (object), UserId 7)
|  4       | DeleteObject                     |            | Ticket 9), ID (object), Type (object) 1), Name (object), PublicationId, IssueIds, EditionIds, SectionId, StateId, Deleted, Deleter, RouteTo (user), LockedBy (user), Version (object), Format (object), UserId, Permanent
|  5       | SaveObject 3)                  |            | Ticket 9), ID (object), Type (object) 1), Name (object), PublicationId, IssueIds, EditionIds, SectionId, StateId, Modified, Modifier, RouteTo (user), LockedBy (user), Version (object), Format (object), UserId 7), OldRouteTo (user)
|  6       | SetObjectProperties              |            | Ticket 9), ID (object), Type (object) 1), Name (object), PublicationId, IssueIds, EditionIds, SectionId, StateId, RouteTo (user), LockedBy (user), Modified, Modifier, Version (object), Format (object), UserId 7), OldRouteTo (user)
|  8       | LockObject                       |            | Ticket 9), ID (object), LockedBy (user)
|  9       | UnlockObject                     |            | Ticket 9), ID (object), LockedBy (user), LockForOffline, RouteTo (user)
|  10      | CreateObjectRelation             |            | Ticket 9), Child (object id), Type (relation) 2), Parent (object id), PlacedOn (parent name)
|  11      | DeleteObjectRelation             |            | Ticket 9), Child (object id), Type (relation) 2), Parent (object id), PlacedOn (parent name)
|  12      | SendMessage                      |            | Ticket 9), UserID, ObjectID, MessageID, MessageType 4), MessageTypeDetail, Message, TimeStamp, MessageLevel, FromUser, ThreadMessageID, ReplyToMessageID, MessageStatus, ObjectVersion, IsRead 12)
|          |                                  |            | Extra fields for Sticky Notes only: AnchorX, AnchorY, Left, Top, Width, Height, Page, Version, Color, PageSequence
|  13      | UpdateObjectRelation             |            | Ticket 9), Child (placable object id), Type (relation) 2), Parent (layout object id), PlacedOn (layout name)
|  14      | DeadlineChanged                  |            | Ticket 9), ID (object), DeadlineHard, DeadlineSoft
|  15      | DeleteMessage                    |            | Ticket 9), MessageID
|  16      | AddToQuery                       |            | Ticket 9), UpdateID 5), ID (object), Type (object) 1), Name (object), PublicationId, SectionId, StateId, RouteTo (user), LockedBy (user)
|  17      | RemoveFromQuery                  |            | Ticket 9), UpdateID 5), ID (object)
|  18      | ReLogOn                          |            | Ticket 9), UserId (the full name of the user that should relogon, without prompting the user with a logon dialog) 8)
|  19      | RestoreVersion                   |            | Ticket 9), ID (object), Type (object) 1), Name (object), PublicationId, IssueIds, EditionIds, SectionId, StateId, Modified, Modifier, RouteTo (user), LockedBy (user), Version (object), Format (object), UserId 7), OldRouteTo (user)
|  20      | CreateObjectTarget               |            | Ticket 9), UserId 7), ID (object), PubChannelId, IssueId, EditionIds
|  21      | DeleteObjectTarget               |            | Ticket 9), UserId 7), ID (object), PubChannelId, IssueId, EditionIds
|  22      | UpdateObjectTarget               |            | Ticket 9), UserId 7), ID (object), PubChannelId, IssueId, EditionIds
|  23      | RestoreObject                    | 8.0.0      | Ticket 9), ID (object), Type (object) 1), Name (object), PublicationId, IssueIds, EditionIds, SectionId, StateId, Deleted, Deleter, RouteTo (user), LockedBy (user), Modified, Modifier, Version (object), Format (object), UserId 7)
|  24      | IssueDossierReorderAtProduction  | 7.0.13     | Ticket 9), PubChannelType, IssueId, DossierIds 10)
|  25      | IssueDossierReorderPublished     | 7.5.0      | Ticket 9), PubChannelType, PubChannelId, IssueId, EditionId, DossierIds 10)
|  26      | PublishDossier                   | 7.5.0      | Ticket 9), DossierId, PubChannelType, PubChannelId, IssueId, EditionId, PublishedDate \[, specific fields 11)\]
|  27      | UpdateDossier                    | 7.5.0      | Ticket 9), DossierId, PubChannelType, PubChannelId, IssueId, EditionId, PublishedDate \[, specific fields 11)\]
|  28      | UnpublishDossier                 | 7.5.0      | Ticket 9), DossierId, PubChannelType, PubChannelId, IssueId, EditionId \[, specific fields 11)\]
|  29      | SetPublishInfoForDossier         | 7.5.0      | Ticket 9), DossierId, PubChannelType, PubChannelId, IssueId, EditionId, PublishedDate \[, specific fields 11)\]
|  30      | PublishIssue                     | 7.5.0      | Ticket 9), PubChannelType, PubChannelId, IssueId, EditionId, Version, PublishedDate \[, specific fields 11)\]
|  31      | UpdateIssue                      | 7.5.0      | Ticket 9), PubChannelType, PubChannelId, IssueId, EditionId, Version, PublishedDate \[, specific fields 11)\]
|  32      | UnpublishIssue                   | 7.5.0      | Ticket 9), PubChannelType, PubChannelId, IssueId, EditionId, Version \[, specific fields 11)\]
|  33      | SetPublishInfoForIssue           | 7.5.0      | Ticket 9), PubChannelType, PubChannelId, IssueId, EditionId, Version, PublishedDate \[, specific fields 11)\]
|  34      | CreateObjectLabels               | 9.1.0      | Ticket 9), ObjectId, Labels 13)
|  35      | UpdateObjectLabels               | 9.1.0      | Ticket 9), ObjectId, Labels 13)
|  36      | DeleteObjectLabels               | 9.1.0      | Ticket 9), ObjectId, Labels 13)
|  37      | AddObjectLabels                  | 9.1.0      | Ticket 9), ParentId, ChildIds, Labels 13)
|  38      | RemoveObjectLabels               | 9.1.0      | Ticket 9), ParentId, ChildIds, Labels 13)
|  39      | SetPropertiesForMultipleObjects  | 9.2.0      | Ticket 9), ObjectIds, properties

1.  ObjectType as specified in the workflow WSDL. Options are: Article, Layout, Image, etc.

2.  RelationType as specified in the workflow WSDL. Options are: Placed, Planned, Contained, etc.

3.  No relations information provided through messaging.

4.  MessageType as specified in workflow WSDL. Options are:
    -   system -&gt; Message generated by system to be shown in GUI
    -   client -&gt; Client application specific message to be shown in GUI
    -   user -&gt; Message from user to be shown in GUI
    -   sticky -&gt; To create or update Sticky Note
    -   reply -&gt; Reply to a Sticky Note

5.  Query update id, returned as UpdateID in NamedQueryResponse. Note that the standard Enterprise Server version 6 and higher does not implement this, it’s only supported by Content Station version 6 and higher for custom content sources.

6. (no longer in use)

7.  UserId is a full name (Enterprise 6 and higher) that defines the user that initiated the action.

8.  Supported by Content Station to allow Content Sources to trigger a re-logon when queries are added/removed. Note that the standard Enterprise Server version 6 and higher does not implement this, it’s only supported by Content Station version 6 and higher for custom content sources.

9.  Instead of sending the actual ticket, the first 12 characters of the MD5 hash of the ticket are sent.

10.  The Dossier IDs are sent in a binary package of uint32 numbers (so each ID takes 4 bytes). The whole package is base-64 encoded. For the Feed Publisher, the IDs are grouped by ‘sections’, for which zero (id=0) is used as a section marker. For DPS, all Dossiers (IDs) are sent that are assigned to an Issue (so a specific sort per Edition/Device is not supported). When there are too many Dossiers to fit into 1K package, the DossierIds field is not sent at all. This is an indication to clients (such as Content Station) to start polling Issue orders instead (through Web services).

11.  specific fields. There can be additional fields depending on the Publishing integration. For example: for the Adobe DPS integration there is one field named ‘PublishStatus’ for all issue events.

12.  Only sent when the message is set to “Read”.

13.  Labels are comma-separated and each label consists of an id and a name attribute separated by a tab: `id\tname`

## RabbitMQ integration \[since 10.0\]

### Basic flow

When a user performs a workflow operation, the client calls a web service. The server executes the service and when completed it sends out an event message to all other clients. For this, the server integrates with RabbitMQ. It sends the message to an exchange (of type ‘fanout’) in RabbitMQ. The exchange distributes this message to all queues that are bound to the exchange. All clients that are continuously listening for the message queues receive the message and update the properties shown in their UI with the received information.

### Setup in RabbitMQ

For each Enterprise installation connected to RabbitMQ, a virtual host is created. For the name of the virtual host, the Enterprise System ID is used. For each brand in Enterprise, an exchange is created in RabbitMQ. For each client logged in to Enterprise, a queue is created in RabbitMQ. The exchanges and queues are created for a specific virtual host. Users are created system wide (prefixed with the Enterprise System ID). If a user has view access to a brand in Enterprise, a binding is created between the queue and the exchange. For each Enterprise installation, one admin user is configured for RabbitMQ. For each virtual host (so each Enterprise installation) one exchange is created for sending system events. All clients logged in to Enterprise have a binding to this exchange.

### Access rights

Users only have access to one virtual host. For each client they are logged in to, one queue can be accessed only. Users have no access to exchanges nor to queues that belong to other users. This implicitly blocks the creation of additional bindings that would give access to other queues. Only those messages will arrive in the user’s queues that originate from the brands the user has access to.

### Overrule issues

Issues that have the Overrule Brand option enabled are much the same as regular brands: for both setups a workflow can be configured including access rights. Therefore wherever ‘brand’ is mentioned in this chapter, this includes overrule issues.

### On logon, server prepares RabbitMQ

When the user logs in to Enterprise, Enterprise Server creates the following resources in RabbitMQ (except when these already exist):
-   a virtual host (using the Enterprise System ID)
-   the user (using the user id prefixed with the Enterprise System ID)
-   the exchanges the user has access to (using the brand ids and overrule issue ids)
-   one message queue
-   bindings between the queue and the exchanges

The user password will be reset in RabbitMQ to make sure it matches with the Enterprise password. For each queue the user permissions are set. In the LogOnResponse, the server provides the configured connections to RabbitMQ and the name of the message queue. This tells the clients how to connect and subscribe for messages. Assumed is that the client applies the same password for RabbitMQ as it used for Enterprise.

### On logon, client subscribes for messages

After a successful logon, the clients looks up the message queue from the LogOnResponse. Only one message queue exists. In the MessageQueueConnections, the clients look up connections that have Instance set to “RabbitMQ” and Protocol set to the one they support, such as “AMQP”, “STOMP” or “STOMPWS”. Note that AMQP has a better performance than STOMP. Next, the client connects to RabbitMQ and logs on the current user. It does this by taking the User name from the connection while the password is taken from the logon dialog because assumed is that the password is the same as used for Enterprise. Once logged in, the clients subscribe for the message queue found in the logon response and provide a callback function.

### On event, server publishes messages

At the end of a workflow web service execution, the server decides to trigger an event. When RabbitMQ is enabled, it connects to the RabbitMQ server using the configured admin account for the AMQP protocol. For object related events, it resolves the brand or overrule issue to determine the corresponding exchange. Else it uses the system event exchange. Then, using JSON, it encodes the properties to be sent and publishes the composed message to RabbitMQ exchange. The exchange (of type ‘fanout’) distributes the message to all bound message queues.

### On event, client receives messages

When a message arrives in the queue, RabbitMQ sends it to all subscribers. On arrival, the callback function is called by the client library. The clients should decode the JSON message and check if the EventId is of their interest. They may expect the properties to be present as specified in the “Events” paragraph in this chapter. For object related events, they may want to update the object properties listed in the UI (by using the object id as a reference). For example, this could be done for the object properties listed in the search results of the client tab or panel.

### On logoff, client should unsubscribe

When the user logs out (or quits the client), the client should unsubscribe from all the message queues. Removing the queues is done by the server and should not be done by the clients.

### Ticket expiration and subscriptions

When the ticket expires, the message queues will be cleaned up by the server. (This cleanup may happen at the moment another user logs on.) When losing the connection with the message queue, clients should keep this in mind. When the queue no longer exists, client should show the re-logon dialog. (When client is in the process of logging out, this dialog should be suppressed.)

### RabbitMQ info in the logon response

The server takes full responsibility for creating the resources in RabbitMQ. This makes it easy for the clients to integrate with RabbitMQ. Although this chapter explains how the server creates the virtual host, exchanges, queues and bindings, clients should never try to understand nor try to mimic, compose or parse those resource names. Instead, clients should read all information from the logon response instead.

The name of the message queue the client should subscribe for, should be looked up in the logon response in the following location:

```xml
<LogOnResponse>
	...
	<MessageQueue>...</MessageQueue>
	...
</LogOnResponse>
```

The connections to RabbitMQ are set up in the MESSAGE\_QUEUE\_CONNECTIONS option in the configserver.php file. Those connections are communicated to the clients through the logon response as well. The client should check for any connection that has Instance set to “RabbitMQ” and Protocol set to the one they support. The connections in the response are listed as follows:

```xml
<LogOnResponse>
	...
	<MessageQueueConnections>
		<MessageQueueConnection>
			<Instance>RabbitMQ</Instance>
			<Protocol>AMQP</Protocol>
			<Url>amqps://localhost:5671</Url>
			<User>d0d9edc5-17b3-4284-fa90-af4dd2b7a551.1</User>
			<Password xsi:nil="true"/>
			<VirtualHost>d0d9edc5-17b3-4284-fa90-af4dd2b7a551</VirtualHost>
		</MessageQueueConnection>
		<MessageQueueConnection>
			<Instance>RabbitMQ</Instance>
			<Protocol>STOMPWS</Protocol>
			<Url>wss://localhost:15673/ws</Url>
			<User>d0d9edc5-17b3-4284-fa90-af4dd2b7a551.1</User>
			<Password xsi:nil="true"/>
			<VirtualHost>d0d9edc5-17b3-4284-fa90-af4dd2b7a551</VirtualHost>
		</MessageQueueConnection>
		...
	</MessageQueueConnections>
	...
</LogOnResponse>
```

### JSON message structure

The messages used for RabbitMQ integration are JSON encoded and have the following format:

```json
{
	"EventHeaders": {
		"EntVersion": "10.0.0",
		"EventId": "1"
	}
	"EventData": {
	  "FullName": "WoodWing Software", 
	  "Server": "Enterprise", 
	  "Ticket": "37ed7620558e", 
	  "UserID": "woodwing"
	}
}
```