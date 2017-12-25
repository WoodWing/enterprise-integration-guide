---
layout: chapter
title: Web Service Interfaces
sortid: 40
permalink: doc1036
---
This chapter describes all flavors of the Web Service interfaces exposed by Enterprise Server. For each flavor, its 
primary purpose is given as well as how it needs to be accessed by client applications.

## Flavors and their purposes
Enterprise Server implements and exposes the following Web Service interfaces, each for a different purpose:

### Workflow interface
This is the most advanced and heavily used interface of all. It defines all supported editorial workflow operations 
such as creating, saving and deleting files. Through this interface, editors and layout designers typically manage 
their articles, Dossiers, layouts, etc. This interface is called by all clients; InDesign, InCopy, Content Station and 
the Web Editor.

### Admin interface
Used for various Brand- and user administration purposes, such as creating Publication Channels for Brands, creating 
users and assigning them to user groups, etc. These operations are only accessible to Brand- or system administrators. 
(With Enterprise 7 the interface is not complete yet. For example, you cannot give users access to a Brand and you 
cannot set up a workflow definition. So, you can set up a basic Brand structure from scratch, but it requires manual 
completion.) The interface is mainly used by the admin web applications. It could also be very useful for third-party 
integrators, such as creating many Issues simultaneously for a specific Publication Channel.

### System Admin interface \[since 9.0\]
Used for installation purposes and for technical administration (other than brand- or user administration). Note that 
the name of this interface does not imply that all its services require system admin access rights. For example, 
end-users in the workflow system can request which sub-applications are configured for them (when the Elvis Server 
plug-in is activated, this service tells whether or not the Elvis app should be shown in Content Station for the 
current user.) Candidate services that could appear in future include Feature Access Profiles, Server Plug-ins, 
Server Jobs, Server Options.

### Planning interface
Through this interface, planning integrations with third-party systems are made, such as Journal Designer (DataPlan) 
and Timone (Tell). Its main goal is to simplify the workflow interface for plan systems and to offer some planning logics. 
Through this interface, planned pages and adverts (created in the planning system) are sent to the Enterprise database. 
InDesign is then able to automatically apply the planned information at the moment layouts are being opened. Planning 
systems create pages based on layout templates.

### Publishing interface
Dossiers can be published to many channels through this interface. This is for instance used for Web CMS and SMS 
integrations (built with Server Plug-in technology). Previews of the published content can be requested. When content 
is outdated it can be unpublished to remove it from the channel again. This interface is mainly called by Content Station.

### Data Source interface
Any external storage carrying structured catalog data can be integrated with Enterprise. Its data can be queried 
through this interface to gain centralized access for client applications. The storage itself can be any database flavor, 
comma-separated value lists, or any other data source. The data can represent anything, such as a product to appear in 
catalogs, or programs to appear in TV-listings. Enterprise Server implements the interface and requests Server Plug-ins 
(containing a DataSource connector) to establish a connection to the external storage and query its structured data. 
Smart Catalog Enterprise is required which calls the interface to query the structured data and automatically build 
any catalog on paper within InDesign.

## Definitions and entry points
The table below can be used to look up definitions and entry points for all interface flavors. The second column 
shows the abbreviation (short name) used internally by Enterprise Server. For example, in the 
.../Enterprise/server/interfaces/services and .../Enterprise/server/service folders you can find subfolders with such 
abbreviations. The third column shows three items of which their meaning is explained below the table. The last column 
shows the Enterprise version in which the interface was officially introduced.

| interface       | short     | WSDL(1), URN (2), web service entry point (3)  | since
------------------|-----------|------------------------------------------------|-----------
|  workflow       | wfl       | SCEnterprise.wsdl                              |  v3
|                 |           | urn:SmartConnection                            | 
|                 |           | .../Enterprise/index.php                       | 
|  admin          | adm       | SmartConnectionAdmin.wsdl                      | v5
|                 |           | urn:SmartConnectionAdmin                       | 
|                 |           | .../Enterprise/adminindex.php                  | 
|  system admin   | sys       | SystemAdmin.wsdl                               | v9
|                 |           | urn:SmartConnectionSysAdmin                    | 
|                 |           | ../Enterprise/sysadminindex.php                | 
|  planning       |  pln      |  SmartEditorialPlan.wsdl                       |  v4
|                 |           | urn:SmartEditorialPlan                         | 
|                 |           | .../Enterprise/editorialplan.php               | 
|  publishing     | pub       | EnterprisePublishing.wsdl                      | v6
|                 |           | urn:EnterprisePublishing                       | 
|                 |           | .../Enterprise/publishindex.php                | 
|  data source    | dat       | PlutusDatasource.wsdl                          | v6
|                 |           | urn:PlutusDatasource                           | 
|                 |           | .../Enterprise/datasourceindex.php             | 
|  admin data source | ads    | PlutusAdmin.wsdl                               | v6
|                 |           | urn:PlutusAdmin                                | 
|                 |           | .../Enterprise/datasourceadminindex.php        | 

**(1) WSDL**

The Web Service Definition Language (WSDL) is a document which defines an interface. This is the communication contract 
between client and server. It lists the server operations (Web Services) exposed to the clients and defines the SOAP 
data structure sent through client requests and received through server responses. The Enterprise WSDL files are 
located in the .../Enterprise/server/interfaces folder. This folder contains more WSDL files than listed in the table. 
Those are for internal use and should NOT be used for integrations.

**(2) URN**

The Uniform Resource Name is used to separate the interfaces from each other. For example, a User entity is defined for 
the workflow- and the admin interface. The one in the admin interface is more detailed. To avoid class name clashes, 
the URN is used as prefix, for example AdmUser. Only for the workflow interface, those prefixes are not applied (this 
is considered the ‘main’ flow which is mostly used).

**(3) web service entry point**

A PHP index file used by client applications to connect to. This can also be used to request the WSDL file, which is 
done as follows: index.php?wsdl. It is recommended to use this method and to parse the received WSDL file client-side. 
WSDL files should never be read from the .../Enterprise/server/interfaces folder because HTTP read access could be denied. 
But also, the server sets the soap:address element on-the-fly before sending the WSDL back to client.

## Inspecting client-server traffic

Once you have read this guide in its entirety, you might wonder how operation sequences (should) take place, or what 
data structures are sent back and forth between clients and server. Playing with existing clients while server DEBUG 
logging is enabled could give you a quick starting point and allows you to examine the process that occurred. This 
could be helpful when you want to create a new client application from scratch, or let your client support new features 
that are exposed by a freshly released Enterpriser Server (or hook into running services by using Server plug-ins, which 
is out-of-scope for this guide). This section tells how this can be done.

In the figure below a scenario is shown in which a user is working with any of the client applications, such as InDesign 
or Content Station. Whenever an action \[1\] is done that requires the help of the server, the client fires a Web Service 
request \[2\] to the server. After processing, the server returns the results through a Web Service response \[3\] back 
to the client. The client mostly gives some kind of reaction \[4\] informing the user that the operation was successful 
(or not) such as a dialog, a document that gets opened, or simply a spinning wheel that has stopped.

![]({{ site.baseurl }}{% link web-services-guide/images/image11.png %})

Playing around is obviously not recommended to do on a production server. There can be cases though where you simply 
want to examine what happens on a very rich data set, typically a production or demo server. When you are not the only 
person working on that server, enabling system wide server logging logs all operations of all users. This cacophony of 
operations will blur the logging you are looking for, as fired by your client only. Therefore, improvements have been 
made in this area since Enterprise Server 8.

## Improved logging \[since 8.0\]

Since Enterprise 8, logging can be enabled per client IP, and for each client IP a separate logging folder is created. 
(See DEBUGLEVELS option described in the Help Center how to configure.) You can add your client IP with a DEBUG value 
so that only for your client application all details are logged.

The following steps show how to inspect the Web Services traffic:

1. Enable DEBUG logging on the server. (See DEBUGLEVELS option in the Help Center.)
1. Set the LOG\_INTERNAL\_SERVICES option to *true* in the configserver.php file.
1. Remove any existing logging from previous sessions.
1. Perform some actions, such as login, create document, check-in document, run a query, etc.
1. Have a look in the log folder. The Web Service requests and responses are logged, all in separate files. Request 
files have a “\_Req” postfix and responses a “\_Resp” postfix.

For example, logging of a LogOn service call could look like this:

![]({{ site.baseurl }}{% link web-services-guide/images/image12.png %})

The name of each HTML log file refers to the PHP file that was used to handle a Web Service or web application. In this 
case, the index\_php.htm file refers to the index.php file. This PHP file can be looked up in *Definitions and entry 
points* and when found, it means that a Web Service was handled. In this case it is found that the workflow interface is 
used. When not found, it could be any of the web applications. The index\_php.htm file contains all logging of the Web 
Service call handling, in this case the LogOn.

The LogOn\_SOAP\_Req.xml file tells that the client has used the SOAP protocol for the LogOn request. The server returns 
the corresponding response (also in SOAP format) as logged in LogOn\_SOAP\_Resp.xml. Drag & drop them into a web browser 
(or XML editor) to view the structured data in readable format.

Because the LOG\_INTERNAL\_SERVICES option is enabled, the WflLogOn\_ Service\_Req.txt and WflLogOn\_Service\_Resp.txt 
files are logged as well. This contains the data model of PHP that is built from the request or response. Note that 
clients could use old structures that are still supported by the new server (for backwards compatibility). The SOAP log 
contains the structure exactly how it was communicated between client and server (in either the old or the new structure). 
The TXT files contains only the new structure (old structure is mapped to new structure by the interface layer of the 
server). This is done to let the core server and the server plug-ins work with new structures only, and not to worry 
them with both structures (old and new).

## Notes

Attached documents (DIME attachments) sent along with SOAP traffic are not logged server side. This is to avoid 
outrageous disk space consumption. InDesign/InCopy clients support DIME logging though.

> **\[Since 8.0\]** For SOAP and JSON the original request is logged. Because AMF is a binary format, this is not done 
for AMF. In such cases you have to rely on the PHP objects logged in TXT format; this can be enabled with the 
LOG\_INTERNAL\_SERVICES option.

## Service validation \[since 8.0\]

Since Enterprise Server 8 it is possible to validate Web Service requests and responses. This is implemented for all 
supported protocols and interfaces. This feature can be enabled with the SERVICE\_VALIDATION option in the 
configserver.php file. It is recommended to enable it when you are developing a client that integrates with Enterprise. 
When a request is found to be invalid, this is a client bug and so please check the *SDK documentation* to fix the problem. 
When a response is not valid, it must be a server bug and so please report it to WoodWing Support. To continue your 
developments in the meantime, please add the path reported to be invalid at the SERVICE\_VALIDATION\_IGNORE\_PATHS 
option in the configserver.php file to suppress the validation error. This allows you to keep the validation enabled, 
which is most important during development and tests.

## Understanding SOAP using a WSDL

There are lots of published documents and books explaining all the ins- and outs of WSDLs in great detail. Much of the 
WSDL technology (features and options) is simply not used by Enterprise. As a starting point, this paragraph takes a 
login response (from the server SOAP log folder) as an example and explains how you can look up its data structure. 
This method can be applied to all client requests and server responses.

In the following steps, used colors refer to the figure shown below:

1. Enable DEBUG logging.\
(See the Help Center how to enable this.)
1. Login with client, which then fires a LogOn request, as logged on the server.
1. Open the SOAP log file, that can be found in the server log folder.
1. Determine the used **URN** `urn:SmartConnection` and look up the WSDL file (by using the table discussed in the 
previous chapter). In this example, you will find the SCEnterprise.wsdl file.
1. Determine the **operation** `<LogOnResponse>` (fired by the client) and use this as a starting point to look up 
the **parameters** `<Ticket>`, `<Publications>`, `...` and **data structure** `<PublicationInfo>` in the WSDL (as 
looked up). This is explained below in more detail.

```xml
<?xml version=”1.0” encoding=”UTF-8”?>
<SOAP-ENV:Envelope 
	xmlns:SOAP-ENV=”http://schemas.../” 
	xmlns:xsi=”http://www.w3.org/...” 
	xmlns:xsi=”urn:SmartConnection”>
<SOAP-ENV:Body>
	<LogOnResponse>
		<Ticket>...</Ticket>
		<Publications>
			<PublicationInfo>
				<Id>1</Id>
				<Name>WW News</Name>
				...
			</PublicationInfo>
		</Publications>
		...
	</LogOnResponse>
</SOAP-ENV:Body>
</SOAP-ENV:Envelope>
```

Open the found SCEnterprise.wsdl file in a web browser and start reading from the bottom up. The type definitions can 
be looked up from the bottom up. All data structure items mentioned can be found this way:

![]({{ site.baseurl }}{% link web-services-guide/images/image13.png %})
```xml
<complexType name="PublicationInfo">
	<all>
		<element name="Id" 	type="xsd:string"/>
		<element name="Name" type="xsd:string"/>
		...		
	</all>
</complexType>
<complexType name="ArrayOfPublicationInfo">
	<sequence>
		<element name="PublicationInfo" ... type="tns:PublicationInfo"/>
	</sequence>
</complexType>
<element name="LogOnResponse">
  <complexType>
	<sequence>
		<element name="Ticket"  type="xsd:string"/>
		<element name="Publications" type="tns:ArrayOfPublicationInfo" .../>
		...
	</sequence>
  </complexType>
</element>
<message name="LogOnResponse">
	<part name="parameters" element="tns:LogOnResponse"/>
</message>
<operation name="LogOn">
	<input message="tns:LogOn"/>
	<output message="tns:LogOnResponse"/>
</operation>
```
