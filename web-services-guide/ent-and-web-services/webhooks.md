---
layout: chapter
title: Webhooks [since 10.13]
sortid: 80
permalink: 1248-webhooks
---
The Webhooks feature has been introduced to enable 3rd-party applications to act on events that take place in the Studio system.

### Current status (10.13.0)
<span style="color: red">**IMPORTANT:** This feature is currently experimental, incomplete and is subject to change. Nevertheless, we invite you to experiment with it. Based on your feedback we can refine and shape this feature into the right direction.</span>

# Concept
This chapter describes how the Webhooks feature works.

## How it works
Some web services have been added to Studio Server which allows a 3rd-party to register a URL to be called when a certain event takes place in Studio Server. For each webhook registration, Studio Server creates a record in the database, and creates a dedicated message queue in RabbitMQ. 

During the registration, the 3rd-party provides a secret token. If not provided, Studio Server returns a secret token instead. Studio Server and the 3rd-party store this secret for later use.

When a user performs an operation that triggers an event, Studio Server makes a snapshot of the data involved and pushes it into the Event Bus. (The Event Bus is another message queue in RabbitMQ that is created by Studio Server.)

A scheduler (crontab, Task Scheduler, Lambda, and so on) periodically calls Studio Server to dispatch the events from the Event Bus message queue to the Webhook registration message queues. Another scheduler periodically calls Studio Server to read events from the Webhook queues and to call the 3rd-party URL, providing the event data. It secures the call by adding a signature that is based on the event data and the secret.

The 3rd-party receives the Webhook request of Studio Server. It reads the event data and signature. It composes a signature based on the request data and the secret. The 3rd-party only accepts the Webhook request when the received and composed signatures are the same .

Now the 3rd-party acts on the event data. This could be as simple as a Lambda in AWS or as sophisticated as a integration platform such as Workato. In both cases it executes a custom script for which the Webhook registration was created. The custom script could do anything, such as:
 * Adding a row to a Google Sheet for each article created in Studio.
 * Updating a record in an external MySQL database to keep track of properties that were modified for a layout in Studio.
 * Downloading a file and uploading it to a 3rd-party image processor for each image created in Studio.
 * ... and so on

To disable the integration, the 3rd-party calls web services to remove the registrations in Studio Server. That stops Studio Server from calling the registered URLs.

## Asynchronous communication
As the workflow user is waiting for an operation to complete, Studio Server quickly offloads event data into the Event Bus message queue of RabbitMQ. After this point, two things will happen in parallel:
1. The user receives a response from Studio Server and continues working, performing subsequential workflow operations. 
1. In the background, the event processors of Studio Server pick up the event data and call the registered Webhooks. The called 3rd-party may also perform subsequential workflow operations.

In short, the user and the 3rd-party integration operate asynchronously (in parallel). This is unlike the basic nature of Studio Server where almost everything for one request gets processed synchronously (sequential). In an asynchronous context it cannot be assumed that certain content is still there, or still the latest version, or still in a locked or unlocked status, and so on. Changes may have made in the meantime. The Event Bus may be a bit behind, or the 3rd-party may have gone offline for a moment, which may worsen this effect. The 3rd-party integration must be aware of this and should take the responsibility to deal with various race conditions and unexpected statuses of content.

Most advisable for a Webhooks based integration is:
 * To base its reaction on the event data itself, without the need to query Studio Server to enrich the data and without the need to update information in Studio Server that is related to the subject (workflow object) of the event. Such integrations will never suffer from the complexity introduced by the asynchronous nature of events.
 * Not to call Studio Server web services. If each event triggers an integration that calls Studio Server, the workflow traffic would duplicate. If this is really needed, try to make it happen less often, such as only for a certain brand, category, status, content type, event type, and so on. 

## Reliability
A registered Webhook always gets called, as long as the messages in the queue do not expire (which can be controlled with a Time to Live setting). 

The sequence of workflow events as they took place in Studio will be respected; Studio Server communicates the events in the very same order to the 3rd-party. Even when there was some network downtime for one or more of the Webhook registrations, the sequence within one registration is preserved, as each registration has its own message queue waiting to get processed. 

Due to performance differences, a certain workflow event may get processed at a different moment for one registration compared to another. In other words, two registrations should not expect to get called on the very same moment in time (for a certain workflow event).

## Supported events
Studio Server supports the following workflow object events:

|  **object event** | **event type** | **takes place after**
|  --------------| -------------| -------------
| Created | `com.woodwing.studio/object/created` | Creating a new object in the workflow.
| Moved to Trash Can | `com.woodwing.studio/object/deleted` | Moving an object from the workflow to the Trash Can.
| Deleted | `com.woodwing.studio/object/deleted-permanently` | Deleting an object permanently (from workflow or Trash Can).
| Restored | `com.woodwing.studio/object/restored` | Restoring a deleted object from the Trash Can (back into the workflow).
| Copied | `com.woodwing.studio/object/copied` | Creating a new object by copying an existing object.
| Saved | `com.woodwing.studio/object/saved` | Saving a new file version for an object.
| Modified | `com.woodwing.studio/object/properties-updated` | Changing the properties of an object using the Properties dialog.

The following object events are currently **not** supported:
* Checkout to lock object for editing, or Abort Checkout to unlock.
* Restore object version from history.
* Change object targets or object relations without changing properties (for example dragging an object to a Dossier).
* Send messages or adding operations to objects.
* Modifications to planned pages or adverts.

## RabbitMQ instances
Studio Server integrates with RabbitMQ to implement two features. Each feature can be enabled or disabled independently. Both features can be hosted in one RabbitMQ instance or each feature can be hosted as a separated RabbitMQ instance. 

| feature | since | communication | queue | configuration | integration
|  --------------| ------------- | ------------- | ------------- | ------------- | -------------
| Push notifications to Studio applications | 10.0.0 | backend to frontend | Message Queue | See [Integrating RabbitMQ in Studio Server](https://helpcenter.woodwing.com/hc/en-us/articles/360041824251) | See [Messages](./messages.md)
| Webhook callbacks to 3rd-party integrations | 10.13.0 | backend to backend | Event Bus | See below | See below

# Configuration
This chapter describes how the Webhooks feature can be set up.

## RabbitMQ configuration
On the [Integrating RabbitMQ in Studio Server](https://helpcenter.woodwing.com/hc/en-us/articles/360041824251) page follow these steps: 
* Before you start
* Requirements
* Installing and configuring RabbitMQ*

*) If you use a separated RabbitMQ instance for the Webhooks feature, there is no need to configure the STOMP protocol. 

## Studio Server configuration
The left column in the table below shows the options that can be found in the `.../StudioServer/config/configserver.php` file which are relevant to configure the Event Bus. The right column shows their equivalent options for the Message Queue. 

| Webhook callbacks / Event Bus | Push notifications / Message Queue
| --- | ---
EVENT_BUS_CONNECTIONS | MESSAGE_QUEUE_CONNECTIONS
EVENT_BUS_CONNECTION_TIMEOUT | RABBITMQ_CONNECTION_TIMEOUT
EVENT_BUS_EXECUTION_TIMEOUT | RABBITMQ_EXECUTION_TIMEOUT
EVENT_BUS_CACERT_FILE | MESSAGE_QUEUE_CACERT_FILE
- | RABBITMQ_MAX_PUBLICATIONS
EVENT_BUS_MESSAGE_EXPIRATION | - 
EVENT_BUS_ACTING_USER | -

Refer to the configuration file for a detailed explanation of the options.

Tip: If you want to use one RabbitMQ installation to host both features, you can simply make the Event Bus options inherit from the Message Queue options by adding them to your `.../StudioServer/config/config_overrule.php` file as follows:
```php
define( 'EVENT_BUS_CONNECTIONS', MESSAGE_QUEUE_CONNECTIONS );
define( 'EVENT_BUS_CACERT_FILE', MESSAGE_QUEUE_CACERT_FILE );
```

Check the `.../StudioServer/config/config_webhooks.php` file for the following options that are relevant to the Webhook feature:
* WEBHOOKS_CONNECTION_TIMEOUT
* WEBHOOKS_EXECUTION_TIMEOUT
* WEBHOOKS_CACERT_FILE
* WEBHOOKS_CONCURRENT_CONNECTIONS

Refer to the configuration file for a detailed explanation of the options.

## Event processor configuration
The event data pushed into the Event Bus message queue of RabbitMQ must be processed. The events must be dispatched to those Webhook queues for which a Webhook registration has been set up.

Subsequently the event data pushed into the Webhook queues must be processed too; the registered Webhook URL must be called to notify the 3rd-party about the event. 

In other words: two processors are required. A scheduler tool can be used to periodically call the processors. You can for example use the Task Scheduler for Windows, crontab for Linux, or a Lambda for AWS. The processors must be called over HTTP for which you can use the cURL commandline tool.

Both processors should be called every minute:

| Processor | URL
| --- | ---
| Event Bus | `http://localhost/StudioServer/eventbusindex.php?exchangename=eventbus`
| Webhook | `http://localhost/StudioServer/eventbusindex.php?exchangename=webhook`

By default, the execution time of the processors is 60 seconds. Make sure that the scheduler runs the processor every minute. If you prefer longer runs, you should obviously adjust the timer for the scheduler, but you should also tell the processor to execute longer. To run for 3 minutes (180 seconds) you should add the following parameter to the URL: `&maxexectime=180`

## Event processor scaling
A single application server could serve many workflow requests in parallel. Each request may cause events to get pushed into the Event Bus, and those could be spread out over multiple Webhook queues. Although this could cause a significant load, the event processors only have to deal with the message queues, which is a relatively light and fast job. Therefore, in normal circumstances, expected is that one pair of event processors can cope with the traffic caused by incoming workflow requests on one application server.  

If you have set up multiple application servers for one Studio Server installation, you may want to scale the event processors accordingly. A good start could be to give each application server its own pair of event processors. 

There are many ways of setting up the event processors which comes with different characteristics. Some examples:

| setup | characteristics
| --- | ---
| A scheduler calls the event processors locally on the application server. | An application server can be added, replicated or replaced without the need to pay attention to the event processors.
| A Lambda on AWS calls the Load Balancer that dispatches traffic to the application servers. | Application servers can be scaled individually from event processors. The continuous load of the event processors gets dispatched to other application servers when an application server is busy. 

If the queues have the tendency to get flooded, it helps to add more event processors. Even processors of the same type can run in parallel without blocking each other; the Event Bus processors can be scaled separately from the Webhook processors.

If there are many Webhook registrations, there are equally many Webhook queues (as each has its own queue). This may lead to an undercapacity of Webhook processors. The same may happen when the 3rd-party to be called is hosted on a very remote location suffering from bad network latency. In those cases it helps to:
 * Add more Webhook processors to the scheduler. 
 * Allow each Webhook processor to call more Webhooks in parallel (by using the `WEBHOOKS_CONCURRENT_CONNECTIONS` option).

# Integration
This chapter describes how a 3rd-party can be integrated with Studio Server by using the Webhooks feature.

## Calling the registration web services
In this paragraph we speak of a 'client' that connects to Studio Server. A client could be any kind of backend process, such as a server application, custom script, Workato recipe, and so on. 

Pick a web service protocol that suits the technology stack of your client:
* JSON-RPC
* SOAP

Both protocols perform and function equally well.

Make your client connect to the service entry point:
* JSON-RPC: `http://localhost/StudioServer/pluginindex.php?plugin=Webhooks&interface=reg&protocol=JSON`
* SOAP: `http://localhost/StudioServer/pluginindex.php?plugin=Webhooks&interface=reg&protocol=SOAP`

### SOAP clients
For SOAP clients, it could be convenient to generate classes based on the WSDL definition. The WSDL can be downloaded as follows: `http://localhost/StudioServer/pluginindex.php?plugin=Webhooks&interface=reg&wsdl=1`. For Java SOAP clients, Studio Server provides pre-generated classes which can be imported from this folder: `.../StudioServer/server/plugins/Webhooks/sdk/java/src/com/woodwing/enterprise/plugins/webhooks/interfaces/services/reg`

For the full definition of all registration web services you can study the WSDL file. There is also a more readable variant in HTML:
* WSDL: `.../StudioServer/server/plugins/Webhooks/interfaces/reg.wsdl`
* HTML: `.../StudioServer/server/plugins/Webhooks/sdk/doc/interfaces/Registration.htm`

### JSON-RPC examples
The examples given in the succeeding chapters are using the JSON-RPC 2.0 protocol. The [JSON-RPC 2.0](https://www.jsonrpc.org/specification) protocol specifies how request objects should be wrapped in envelopes. To improve readability, the examples in the succeeding chapters do not show those envelopes. It is assumed that your client application uses a library that automatically wraps the requests in the envelopes for you. The only part you need to compose are the request objects itself, as shown in the examples. If you do not use such library, you need to wrap each request yourself in an envelope, which has the following structure:
```json
{
	"jsonrpc":"2.0",
	"method":<<<_your_request_name_>>>,
	"params": {
		"req":<<<_your_request_object_>>>
	},
	"id":<<<_your_request_identifier_>>>
}
``` 
Example of a `GetTriggerOptionsRequest` (including the envelope) looks like this:
```json
{
	"jsonrpc":"2.0",
	"method":"GetTriggerOptions",
	"params": {
		"req": {
			"Ticket": "b378ce0aUkpaLEx6PKvMNiB8vFZDWsdWc4bT3Uzk",
			"__classname__": "WhRegGetTriggerOptionsRequest"
		}
	},
	"id":1
}
``` 
The same applies to the response objects; A web service response arrived at your client application is also wrapped by a JSON-RPC envelope. To access the response object, the envelope needs to be unwrapped, which is normally taken care of by your library. Obviously, without such library you have to take care of this yourself.

## Registering a Webhook
Log on to Studio Server with system administration credentials to obtain a valid `Ticket`.

Find out which event types are currently supported by the Studio Server installation you connect with.

Request:
```json
{
  "Ticket": "b378ce0aUkpaLEx6PKvMNiB8vFZDWsdWc4bT3Uzk",
  "__classname__": "WhRegGetTriggerOptionsRequest"
}
```
Response:
```json
{
	"Options": [
		{
			"Entity": {
				"Name": "object",
				"DisplayName": "Object",
				"__classname__": "WhRegEntity"
			},
			"EventTypes": [
				{
					"Name": "com.woodwing.studio/object/created",
					"DisplayName": "Object Created",
					"__classname__": "WhRegEventType"
				},
				{
					"Name": "com.woodwing.studio/object/deleted",
					"DisplayName": "Object Moved to Trash Can",
					"__classname__": "WhRegEventType"
				},
				...
			],
			"__classname__": "WhRegTriggerOptions"
		}
	],
	"__classname__": "WhRegGetTriggerOptionsResponse"
}
```
Create a Webhook registration for the event types you want to get called back for. Only request for event types that are supported. The following example creates a Webhook registration for the Created and Deleted events (taking place for workflow objects).

Request:
```json
{
	"Ticket": "b378ce0aUkpaLEx6PKvMNiB8vFZDWsdWc4bT3Uzk",
	"Registration": {
		"Id": null,
		"Name": "FooBar",
		"Url": "https://hello.world.com/webhooks/FooBar",
		"SecretToken": null,
		"Triggers": [
			{
				"EntityName": "object",
				"EventTypes": [
					"com.woodwing.studio/object/created",
					"com.woodwing.studio/object/deleted"
				],
				"__classname__": "WhRegTrigger"
			}
		],
		"__classname__": "WhRegWebhookRegistrationInfo"
	},
	"__classname__": "WhRegCreateWebhookRegistrationRequest"
}
```
If you want Studio Server to generate a `SecretToken`, pass in a `null` value as shown in the request above. Alternatively, provide your own randomly generated GUID in the `SecretToken` property in the request. The GUID should consist of hexadecimal characters in `8-4-4-4-12` format.

Response:
```json
{
	"Registration": {
		"Id": 123,
		"Name": "FooBar",
		"Url": "https://hello.world.com/webhooks/FooBar",
		"SecretToken": "fd02dd87-5d3e-1689-1199-6ec626ec1d7c",
		"Triggers": [
			{
				"EntityName": "object",
				"EventTypes": [
					"com.woodwing.studio/object/created",
					"com.woodwing.studio/object/deleted"
				],
				"__classname__": "WhRegTrigger"
			}
		],
		"__classname__": "WhRegWebhookRegistrationInfo"
	},
	"__classname__": "WhRegCreateWebhookRegistrationResponse"
}
```
Save the `SecretToken` in your local store.

Log out from Studio Server.

## Accepting a Webhook request
The [CloudEvents - Web Hooks for Event Delivery v1.0.1]( https://github.com/cloudevents/spec/blob/v1.0.1/http-webhook.md) standard is respected for communication.

It is the responsibility of the 3rd-party to determine whether the incoming Webhook request:
 * Originates from a trusted Studio Server installation
 * Corresponds to a Webhook registration created by the 3rd party
 * Has not been modified (man-in-the-middle attack)

This can be done as follows:
1. Check whether it is a HTTP POST request. Deny access for other HTTP methods. 
1. Check whether it is a HTTPS request. Deny access for non-SSL encrypted request.
1. Read the `X-Hook-Signature` entry from the HTTP headers. This is the signature provided by the caller (expected to be Studio Server).
1. Take the event data from the HTTP body.
1. Read the secret token from your local store.
1. Create your own signature by composing a HMAC using the SHA256 encryption algorithm providing the event data and the secret token. See examples below.
1. Check whether the provided signature equals the one you have composed yourself. Deny access when different.

Example in Java:
```
import org.apache.commons.codec.binary.Hex;
import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;

Mac hmac = Mac.getInstance( "HmacSHA256" );
SecretKeySpec secretKeySpec = new SecretKeySpec( secretToken.getBytes( "UTF-8" ), "HmacSHA256" );
hmac.init( secretKeySpec );
String signature = Hex.encodeHexString( hmac.doFinal( httpBody ) );
```

Example in Node.js:
```
var crypto = require('crypto');
var hmac = crypto.createHmac( "sha256", secretToken );
hmac.update( httpBody );
var signature = hmac.digest( "hex" );
```

Example in PHP:
```
$signature = hash_hmac( 'sha256', $httpBody, $secretToken );
```

Example in Ruby:
```
require 'openssl'
signature = OpenSSL::HMAC.hexdigest( 'SHA256', secret_token, httpBody )
```

Example in Workato:
```
signature = payload.hmac_sha256( input['secret_token'] ).encode_hex
```

## Parsing Webhook event data
The [CloudEvents v1.0.1](https://github.com/cloudevents/spec/blob/v1.0.1/spec.md) standard is respected to structure the event data.

The data uses the UTF-8 character set and has a JSON structure like this:
```json
{
	"id": "urn:uuid:382a0b90-114b-0f0b-0633-5e74bd79bf91",
	"source": "urn:uuid:237a16a6-4a67-ebe4-498b-f330a1e3f429",
	"specversion": "1.0",
	"type": "com.woodwing.studio/object/created",
	"datacontenttype": "application/json",
	"subject": "object",
	"time": "2021-05-31T12:00:00Z",
	"data": {
		"Object": {
			"Metadata": { ... },
			"Targets": { ... }
		}
	}
}
```

The `id` is unique per event.

The `source` element contains the `Enterprise System ID` (prefixed by `urn:uuid:`) which is unique per Studio Server installation.

The `data` element contains an `Object` for which `Metadata` and `Targets` are provided. The structure of those elements is defined in the workflow service definition (SCEnterprise.wsdl file).

## Disabling or removing a Webhook registration
Simply remove a Webhook registration if it needs to be disabled. (And create a new registration to enable.)

If the 3rd-party did not track the registration `Id` and only knows the `Name` of the Webhook, the `Id` should be resolved first by retrieving the registration.

Request
```json
{
	"Ticket": "b378ce0aUkpaLEx6PKvMNiB8vFZDWsdWc4bT3Uzk",
	"Id": null,
	"Name": "FooBar",
	"__classname__": "WhRegGetWebhookRegistrationRequest"
}
```

Response:
```json
{
	"Registration": {
		"Id": 123,
		"Name": "FooBar",
		"Url": "https://hello.world.com/webhooks/FooBar",
		"SecretToken": null,
		"Triggers": [
			{
				"EntityName": "object",
				"EventTypes": [
					"com.woodwing.studio/object/created",
					"com.woodwing.studio/object/deleted"
				],
				"__classname__": "WhRegTrigger"
			}
		],
		"__classname__": "WhRegWebhookRegistrationInfo"
	},
	"__classname__": "WhRegGetWebhookRegistrationResponse"
```

Remove the Webhook registration by providing the registration `Id`.

Request:
```json
{
	"Ticket": "b378ce0aUkpaLEx6PKvMNiB8vFZDWsdWc4bT3Uzk",
	"Id": 123,
	"__classname__": "WhRegDeleteWebhookRegistrationRequest"
}
```

Keep in mind the race condition of having events in the queue that serves the Webhook registration being removed. While removing:
 * Your Webhook can still be called.
 * The queue is removed by Studio Server including any pending events. For those events, no more Webhook calls will be made to your integration.
