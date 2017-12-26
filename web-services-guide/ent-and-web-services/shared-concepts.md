---
layout: chapter
title: Shared Concepts
sortid: 60
permalink: 1033-shared-concepts
---
This chapter describes concepts used in all Web Service interfaces.

## WSDL

Each interface is described with a separate WSDL. The WSDL v1.1 specification distinguishes between two message styles: 
document and RPC. Furthermore there are different serialization formats, with SOAP encoding and literal being the two 
popular serialization formats today. The WSDLs shipped with Enterprise Server all use the document message style with 
literal encoding, also known as document/literal.

## Attachments

The Web Service interfaces use XML messages through an HTTP connection. Any files transferred are sent through SOAP 
attachments with DIME being used to encapsulate this into a single data stream. The SOAP message itself and the 
attachments are all encapsulated by DIME. To handle a DIME request or response, the DIME must be parsed to be able 
to access the SOAP message itself. There are only a few Web Services that transfer files, which is limited to the 
workflow- and planning interfaces. Those can be recognized by the *dime:message* element shown for the few operations 
in the WSDL, for example:

```xml
<operation name="CreateObjects">
	<soap:operation soapAction="urn:SmartConnection#CreateObjects"/>
	<input>
		<dime:message 
			layout="http://schemas.xmlsoap.org/ws/2002/04/dime/closed-layout" 
			wsdl:required="false"/>
		<soap:body use="literal"/>
	</input>
	<output>
		<soap:body use="literal"/>
	</output>
</operation>
```

Note that the *input* element stands for the SOAP request fired by the client and the *output* element for the SOAP 
response returned by the server. The fragment above tells us that the CreateObjects operation (Web Service to upload 
documents) accepts DIME attachments, but that none are returned, which makes sense.

For more information on SOAP attachments, see [here](http://www.w3.org/TR/soap12-af/).

For more information on DIME encapsulation, see [here](http://www.watersprings.org/pub/id/draft-nielsen-dime-soap-01.txt).

Since Enterprise 8, it is recommended to use the *Transfer Server* instead of DIME. For both technologies, the DIME 
definitions in the WSDLs specify what service requests or responses can deal with file attachments.

## Errors

A SOAP *Fault* is returned to clients when an error has occurred server-side during any Web Service execution. 
For example:

```xml
<SOAP-ENV:Envelope>
	<SOAP-ENV:Body>
		<SOAP-ENV:Fault>
			<faultcode>SOAP-ENV:Client</faultcode>
			<faultstring>Access denied (S1002)</faultstring>
			<faultactor/>
			<detail>1661(C)</detail>
		</SOAP-ENV:Fault>
	</SOAP-ENV:Body>
</SOAP-ENV:Envelope>
```

When the *faultcode* is set to Client it means that the caller has somehow passed wrong parameters or tries to do 
something that is against the rules. When set to Server it means that the server is not ‘willing’ to process the 
operation or has an internal error. It is a rough indication who might have caused the error: Client or Server. 
Typically used for debugging.

The *faultstring* is a localized string that can be directly shown to the user. The server error code is attached to 
this message in “(Sxxxx)” format. Clients that need to know what error occurred, should parse this error code, for 
example by taking the code 1002 in the given example. Clients sometimes know better what happened than the server, 
especially when firing many requests to establish one logical heavy operation. They are free to interpret the error 
code and display other messages (other than the ones returned to the client) to help the user understand what happened. 
The 1000-1999 range is reserved for operational errors; the 2000-2999 range is reserved for license errors.

Depending on the fault, a *detail* message can also be provided by the server to pass on extra information. The detail 
message is not localized and mostly cryptical, so it should never be shown to end users. In the given example, the 
server informs that the requested operation was performed for an object (ID=1661), for which the user has has no Change 
Status (C) access rights. Clients could try to parse this, but its format is free and subject to change. So, it is not 
recommended and should be used only in exceptional cases. For example, the server can add tokens as well to the *detail* 
message; for example in case an invalid ticket is passed (perhaps because it is expired) a fault is returned with 
*detail* message set to “SCEntError\_InvalidTicket”. This should be checked by clients to determine if there is a need 
to raise the re-logon dialog.

## Tickets

Most Web Services require a ticket as input parameter. This ticket is obtained from the LogOn operation. The LogOn 
operation validates the user name and password and returns a ticket when the user account is valid. The ticket is used 
by clients for subsequent requests. Tickets are interchangeable between all interfaces.

By default, a logon/ticket session expires within 24 hours (or 1 hour for web clients). Whenever a request with a valid 
ticket arrives, the server resets its expiration timer for that session. As long as requests are fired before the 
expiration ends, clients are able to continue working, thereby keeping one license seat occupied. When a ticket has 
expired, an error is returned and the client needs to re-logon obtaining a new/different ticket. At this point, the 
clients risks that the last seat was taken in the meantime.

When the very same user does logon with the very same client application, but from a different location (IP address), 
the server assumes the user has moved. And so, the ticket from the first application is made invalid. This is to avoid 
accidentally keeping two license seats occupied for the whole day.

### Cookie based tickets

Since Enterprise Server 10.2.0 it is possible to omit the ticket in the operation payload. When executing a LogOn 
operation the server will return the ticket as an cookie as well as in the content of the response. When the client 
has support for cookies (implemented a ‘cookie jar’), then the cookies are round tripped with every request to the server.

A cookie is set per AppName in the LogOn request. This allows multiple cookies to be set in the same cookie container 
for different clients. This occurs for example when you have multiple clients running in the same browser instance.

For the server to select the correct cookie it needs to know the AppName that is sending the request. A client can send 
this information by adding a special HTTP header to the request:

`X-WoodWing-Application: <App Name as given in the LogOn response>`

If the client can’t add the header for the request, a HTTP GET parameter can be added to the URL. This can occur for 
example when you want to load an image directly from the Transfer Server in an HTML img tag.

`http://123.123.123.123/transferindex.php?...&ww-app=<AppName>`

Note that this feature is just an addition to Enterprise Server. The ticket given in the request body will be supported 
side-by-side.

## Services

Unlike the stored information in the database, Enterprise Server itself is stateless. Every requested service runs on 
its own. When one service depends on another service, typically resulting data from one is passed on to the other. 
For example, an object id returned through a search query can be used to open the object file for editing.

Each service intends to represent one user operation. In other terms, when a user performs one action, there should be 
just one service executed only. This is needed for two reasons:

* **Performance** - Think of a slow connection with one second network overhead. Performing five requests will require 
five seconds extra wait time, which is unacceptable.

* **Architecture** - One service representing one logical action implies the need of passing all information to execute 
the service. This makes it possible to interpret the intention of the operation, which is why it is a good thing to 
develop custom solutions using Server Plug-ins hooking into Web Services.

However, in some cases multiple services are called by client applications, trigged by one logical action. For example, 
when a user logs in, Content Station typically requests to execute the inbox query immediately after, to show objects 
assigned to that user. Such scenarios are valid since running a query is a totally different logical operation than 
the login.

Client applications can wait for each service to complete and then fire a next request. This synchronous communication 
method works well but is far from optimal. Calling services asynchronously is allowed by Enterprise Server and can 
significantly speed up end user wait times. Content Station does this (by running multiple threads). Obviously, this 
can be done when there are no specific dependencies between services (as mentioned above).

## Arrays

One of the most often used structures in SOAP is the array. It allows transferring many of the same entities (objects, 
relations, pages, etc.) in a list through requests and responses. The way arrays must be formatted is specified in the 
WSDL. For Enterprise, those definitions are always prefixed with `ArrayOf` followed by the entity name. For example:

```xml
<complexType name="ArrayOfPlacement">
	<sequence>
		<element name="Placement" minOccurs="0" maxOccurs="unbounded" type="tns:Placement"/>
	</sequence>
</complexType>
```

It tells SOAP messages using this type that zero to many `Placement` elements are allowed. The elements must be 
structured as follows:

```xml
<Placements>
	<Placement>
		...
	</Placement>
	<Placement>
		...
	</Placement>
</Placements>
```

\[Since 7.0\] Since Enterprise 7.0 this notation has been changed to meet new standards with better support of SOAP 
tools. The definition has been changed in such a way that the old notation (usage) is still supported though:

```xml
<complexType name="ArrayOfPlacement">
	<complexContent>
		<restriction base="soap-enc:Array">
			<attribute ref="soap-enc:arrayType" wsdl:arrayType="tns:Placement[]"/>
		</restriction>
	</complexContent>
</complexType>
```

This tells the same as before, but now a new notation can be used too:

```xml
<Placements SOAP-ENC:arrayType="ns1:Placement[]" xsi:type="SOAP-ENC:Array">
	<item>
		...
	</item>
	<item>
		...
	</item>
</Placements>
```

Basically, the parent `Placements` attributes says that its child `item` elements are actually `Placement` elements. 
For Enterprise 7, Content Station uses this technique, while InDesign / InCopy still use the ‘old’ method.

## User access rights

One of the keystones of the Enterprise workflow system is support for user access rights. Whenever an end user tries 
to do something for which no access is granted, and “Access denied (S1002)” error is raised. This should be determined 
by the server only and not by client applications. In such a case, the server returns a SOAP fault (see *Errors*). 
Such an error is shown in a dialog that is raised by client applications.

### Enabling vs disabling access

Access rights are defined through Access Profiles. (See the Help Center for information about how to configure these.) 
Access feature options can be selected, which means they are enabled. However, when not selected, it does not(!) 
disable the feature; it only means that the feature is not enabled in this particular access profile, so you are not 
blocking access or something like that. A user has no access for a certain feature if there is no profile found with 
the corresponding option selected. For this reason, it is recommended to split options through many profiles and enable 
just a few. (This instead of having all enabled and disabling a few.) Else you might find yourself wondering why an end 
user has gained access unexpectedly.

### Interpreting access definitions

When the end user performs a login action to the system, the server returns the configured profile definitions (through 
the LogOnResponse -&gt; FeatureProfiles element) made by the admin user that are relevant for the end user. Only access 
options that have no default value are returned. You can determine the defaults by creating a new Access Profile through 
the admin pages and see which ones are selected. (At least up to v7.0 all options are selected by default, with the 
exception of the “Force Track Changes” option.)

Let’s say that the system admin creates one Access Profile, clears the “Create Dossiers” option and names it “no Dossier 
creation”. The definition in the login response will look as follows:

```xml
<LogOnResponse>
	...
	<FeatureProfiles>
		<FeatureProfile>
			<Name>no Dossier creation</Name>
			<Features>
				<AppFeature>
					<Name>CreateDossier</Name>
					<Value>No</Value>
				</AppFeature>
			</Features>
		</FeatureProfile>
		...
	</FeatureProfiles>
	...
</LogOnResponse>
```

Note that the “Create Dossiers” is a localized term. To uniquely identify this access feature, internal keys are used 
(in this case *CreateDossier)*. Those keys can be used by client applications to look up and interpret. For example, a 
client application implementing a Create Dossier operation could check for this specific key.

With the definition available, the Brand admin can use it to give the end user access to the Brand in the Authorization 
Maintenance admin page. Let’s say that the Brand admin has given the end user access to the WW News Brand through the 
“no Dossier creation” profile (for all statuses and all Categories).

When the end user performs a login action, this configuration is reflected in the login response too (through Publications 
-&gt; PublicationInfo -&gt; FeatureAccessList element). See the figure below. The profile name (the text marked in red 
in the figure below) refers to the profile definition (the text marked in red in the figure above). This way clients 
can look up definitions. Because the Brand admin user has configured for all statuses and all Categories, respectively 
*State* and *Section* elements are not provided (*xsi:nil* attribute set to “true”). Nil typically means no specific 
item configured, which implies all options. (Note that Category was formerly named Section.) When configured, an id is 
filled in for those elements. When access rights are configured for an Issue with the “Overrule Brand” option enabled, 
the *Issue* element is used to pass its id.

```xml
<LogOnResponse>
	...
	<Publications>
		<PublicationInfo>
			<Id>1</Id>
			<Name>WW News</Name>
			...
			<FeatureAccessList>
				<FeatureAccess>
					<Profile>no Dossier creation</Profile>
					<Issue xsi:nil="true"/>
					<Section xsi:nil="true"/>
					<State xsi:nil="true"/>
				</FeatureAccess>
			</FeatureAccessList>
		</Publications>
	</PublicationInfo>
	...
</LogOnResponse>

```

### Disabling GUI items

For user convenience, the client application GUI can be enhanced by hiding/disabling operations that are expected to 
always fail for a specific context. For example, when the user is not allowed to create Dossiers at all, no matter what, 
the client application could disable the “Create Dossier” operation in its GUI (such as context menus). Nevertheless, 
this must be done with great care. When disabling is done too rigidly it could accidentally withhold users from doing 
operations that they are allowed to. This can be implemented by interpreting the login response, specifically the two 
areas mentioned in the examples above. When the user is working in the context of the WW News Brand (for example 
selected in the GUI) the client needs to check all the profiles for that Brand (by looking up the profile definitions 
as explained above). If none of them gain access to the *CreateDossier* feature, it is safe to disable the “Create Dossier” 
operation in the GUI. If the context of the Brand is undetermined (for example global view on the system) all profiles 
(of all Brands) need to be checked. When the currently selected Issue (if any) has the Overrule Brand option set, only 
the configurations made for the Issue should be checked (and the configurations for its Brand should be ignored!).

### Overruling access rights

When normal configurations made through admin pages do not fulfill the customer’s needs, Server Plug-ins could be the 
answer. Its connectors allow you to hook into any workflow service. See the Server Plug-ins documentation for more info. 
When any operation is not allowed, the connector could throw a BizException as follows:

```php
throw new BizException( 'ERR_AUTHORIZATION', 'Server', '' );
```

For example, it could check if the end user is member of a specific user group, it could check the status of the object 
involved, it could check the deadline and system time, etc, and then decide to block access.
