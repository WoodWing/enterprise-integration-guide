---
layout: chapter
title: Transfer Server [since 8.0]
sortid: 30
permalink: 1035-transfer-server
---
Enterprise Server 7 (and earlier versions) supports the SOAP protocol through which files can be sent as DIME attachments. 
Because DIME has some performance- and integration disadvantages, Enterprise Server 8 supports a technique that can be 
used instead of DIME: the Transfer Server. This chapter explains how to *integrate* the Transfer Server. (How to *deploy* 
the Transfer Server can be found in the Help Center.)

## Why no longer DIME?

Sending DIME attachments through SOAP implies that all request- and response data must be sent through one HTTP connection 
as one long binary stream. This has some important disadvantages:
* For remote workers (longer distances), the throughput of the traffic safe HTTP protocol drops significantly due to 
packet loss and round trip times.
* Sending file attachments along with messages, results in heavy memory consumption on both sides; client and server. 
A server claiming most of the memory to serve one client request could result into swapping out other server processes 
serving other clients. Memory swapping (to disk) leads to significant and unpredictable performance drops.
* DIME is superseded by MTOM and therefore it got more or less dropped by 3rd-parties (such as .NET and Java). This 
makes it hard for integrators to use such 3rd-party tools to build a client talking to Enterprise Server. However, MTOM 
has the same disadvantages as mentioned above. And, both protocols are bound to SOAP, which claims the need to introduce 
an alternative file transfer technique when introducing alternative protocols.

## Introduction

Enterprise Server 8 can act as the Transfer Server. (How to set up and configure this is explained in the Help Center.) 
The Transfer Server handles file uploads and downloads. This way, files travel through a different HTTP connection than 
the service requests and responses. The Transfer Server by itself is already quite a bit faster than DIME and has a much 
lower memory footprint, but moreover it allows the clients to implement various performance improvements that really 
make a difference, such as:
* Upload/download files asynchronously and/or in parallel
* Skip download of locally cached files
* Report errors from the service -before- upload/download (large) files
* Use standard SOAP parsers that does not handle DIME

System administrators can set up the Enterprise Server on one machine and the Transfer Server on another. And, there can 
be multiple Enterprise Servers and multiple Transfer Servers, all working together serving a group of client machines. 
This way, advanced load balancing is possible with use of HTTP server dispatchers. The Enterprise Server tells clients 
which Transfer Server to use by returning the feature 'FileUploadUrl' in the LogOnResponse. (The value is taken from the 
HTTP\_FILE\_TRANSFER\_REMOTE\_URL option in the configserver.php file.)

The Transfer Server needs a folder to temporarily store files that are sent between clients and servers. This is called 
the Transfer Folder. Note that the Enterprise Server needs access to the temp files as well.

## File operations / HTTP methods

The client uses HTTP requests to upload, download or delete files in the Transfer Folder. There is only one entry point 
http://&lt;FileUploadUrl&gt;/transferindex.php that accepts the following HTTP request methods to upload, download or 
delete a file:
* HTTP PUT: upload
* HTTP GET: download
* HTTP DELETE: delete

For clients that do not support these HTTP methods, they can use POST and give an additional parameter 'httpmethod' in 
the URL like this:

`http://123.123.123.123/transferindex.php?...&httpmethod=DELETE`

Regardless of the HTTP method used, each request must have a ‘fileguid’ and a ‘ticket’ parameter:

`http://123.123.123.123/transferindex.php?fileguid=<GUID>&ticket=<TICKET>`

For file downloads, the ‘fileguid’ is already part of the file URL returned by the server through the GetObjectsReponse, 
but for file uploads clients need to create a new global unique identifier (GUID) in 8-4-4-4-12 format. For example:

`690aebdf-93d1-ea99-6597-800994575d8c`

The ‘ticket’ is returned by the server in the LogOnResponse, which needs to be picked up by clients. Only requests that 
send a valid ticket are handled by the Transfer Server. When the ticket is not valid, a HTTP 403 error is returned. 
Clients should check if the error message contains the “SCEntError\_InvalidTicket” token. If so, the client should try 
to re-logon, and when successful, it should repeat the last operation with the Transfer Server (such as the file upload 
or download).

Since Enterprise Server 10.2.0 it is also possible to send the ticket as a cookie. The ‘ticket’ parameter can then be 
omitted in the URL. This only works when the Transfer Server is accessible over the same URL as the Enterprise Server 
instance. In other words the Transfer Server can’t be installed on a separate machine if you want to use this feature. 
More information about cookie based tickets can be found later in this document.

## Uploading files

The figure below shows how file attachments travel along services when uploading files (such as the CreateObjects or 
SaveObjects workflow services). With v7 clients, they both travel through the same request and connection. With v8 
clients, there are two connections; one to the Enterprise Server and one to the Transfer Server. In this case, clients 
can choose between SOAP or JSON. The red color shows how request data travels through the system. The file 
attachments are shown in purple.

![]({{ site.baseurl }}{% link web-services-guide/images/image6.png %})

When clients log in, they catch a new option named ‘FileUploadUrl’ from the FeatureSet element of the LogOn response. 
When the HTTP Transfer Server is configured, the value could look like this:

`http://123.123.123.123/transferindex.php`

For each file to upload, clients create a new global unique identifier (GUID) in 8-4-4-4-12 format. For example:

`690aebdf-93d1-ea99-6597-800994575d8c`

Files are then uploaded through a HTTP PUT command whereby the GUID is passed like this:

`http://123.123.123.123/transferindex.php?fileguid=<GUID>&ticket=<TICKET>`

Uploads are done chunk-wise to reduce memory consumption. Clients need to catch unexpected errors (HTTP 4xx / 5xx) and 
need to follow redirections (HTTP 3xx). When uploaded, the used URL must be filled in at the Attachment-&gt;FileUrl 
element in the service request.

## Downloading files

The following figure shows how files are downloaded, such as for the GetObjects workflow service.

![]({{ site.baseurl }}{% link web-services-guide/images/image7.png %})

The server returns the file location through the service response in Attachment-&gt;FileUrl elements. Such URLs looks 
like this:

`http://123.123.123.123/transferindex.php?fileguid=<GUID>&ticket=<TICKET>`

When the client is using a 3rd-party widget that shows a preview directly (without saving locally), an optional parameter 
named “inline=1” can be given. (For example, this is used by the Content Station Web Edition.) Then, the Transfer Server 
returns through the HTTP response header the disposition attribute set to “inline” value. When the inline parameter is 
left out, the disposition is set to the “attachment” value, resulting in a Save-As dialog.

Additionally to the URL example given above, there is another parameter, named “format”. This contains the mime-type of 
the file to download. This parameter is required and provided by the server. It enables the Transfer Server to return the 
Content-Type field through the HTTP response header.

The client can check its local cache if this version of the file has already been downloaded before. If not, it retrieves 
the file through a HTTP GET command by following the given URL. Downloads are done chunk-wise to reduce memory consumption. 
Clients need to catch unexpected errors (HTTP 4xx / 5xx) and needs to follow redirections (HTTP 3xx).

Since Enterprise 10.0.0 / 9.8.2 / 9.4.9 there is an optional parameter named “filename” to improve integrations with HTML 
based clients, such as Content Station HTML. When provided, the Transfer Server returns that filename in the 
Content-Disposition header enriched with a file extension (as resolved through the EXTENSIONMAP option in the 
configserver.php file). For previous versions, or when the “filename” parameter is left out, the fileguid is returned instead.

## Compression for up-/downloading files \[since 9.5\]

In order to reduce the upload and download time of files for remote users, the File Transfer Server can compress and 
de-compress files by using a file compression technique. Whether or not compression is actually used is defined by the 
client, while the File Transfer Server informs the client which compression techniques are available.

The compression techniques are returned in the LogOnResponse by a feature named ‘AcceptsCompressions’:

```xml
<ServerInfo>
    ...
    <FeatureSet>
        <Feature>
            <Key>AcceptsCompressions</Key>
            <Value>deflate</Value>
        </Feature>
    </FeatureSet>
    ...
```

In the above example, the client is informed that the 'deflate' compression technique can be used. When multiple 
techniques are defined, these are comma-separated. These techniques are built-in and therefore the features are 
provided automatically and they can not be configured. Currently, ‘deflate’ compression is supported only.

## Remote workers and remote locations \[since 9.5\]

File compression should only be used for remote workers. To differentiate such workers from local workers, the options 
named ‘REMOTE\_LOCATIONS\_INCLUDE’ and ‘REMOTE\_LOCATIONS\_EXCLUDE’ of the configserver.php file are used. For a full 
explanation on how to use these options, see the comments in the configserver.php file.

In the LogOnResponse, Enterprise Server returns this as follows:

```xml
<ServerInfo>
    ...
    <FeatureSet>
        <Feature>
            <Key>IsRemoteUser</Key>
            <Value>true</Value>
        </Feature>
    </FeatureSet>
    ...
```

If the Value equals ‘true’, the client IP is treated as remote (according to the configuration options), else ‘false’ 
is returned.

When the ‘IsRemoteUser’ feature is set to ‘true’ and the ‘AcceptsCompressions’ feature lists the ‘deflate’ technology, 
the client could request the Transfer Server to compress a file (server side) while downloading as follows:

`http://123.123.123.123/transferindex.php?…&compression=deflate`

In the same manner, it could request the Transfer Server to uncompress the file (server side) while accepting a file 
being uploaded.

Regardless of the features returned in the LogOnResponse, it is up to the client to decide whether or not (and when) 
to apply compression. Please use compression with care. For example: it does not make sense to compress JPEG or ZIP 
because these files are already compressed. It would lead to taking up CPU processing without an actual reduction in 
file transfer time.

Content Station 9.5 uses Deflate compression when remote users are saving (uploading) or opening (downloading) WCML 
articles. This feature becomes affective when in the LogOnResponse the ‘IsRemoteUser’ feature is set to ‘true' and the 
‘AcceptsCompressions’ feature lists the ‘deflate’ technology.

## Signed Transfer Server URLs \[since 10.7\]

Since Enterprise Server version 10.7.0 it is possible to request signed download links from the server. The signed URL 
allows clients to download files from the Transfer Server without knowing the ticket and fileguid. The signed url can 
only be generated with a client that has a valid session ticket and the token is only valid for a specific period of 
time for only the file it was generated for. This feature is useful when you want to get a download link and pass it to a 
different application (for example for downloading). 

To request a signed URL from the server you can add the following parameters to the web service entry point. An example 
URL would be: 

`http://123.123.123.123/index.php?protocol=JSON&transfer=HTTP&signedUrls=true&autoCleanUrls=true`

The possible options are:

* compressionEnabledUrls
    * When compressionEnabledUrls is true the compression parameter will be added to the url or added to the token when 
    signedUrls is true. The compression parameter is automatically set to 'deflate'.
* signedUrls
    * When signedUrls is true a token will be generated that is valid for a number of seconds as configured with 
     FILE_TRANSFER_SIGNED_URL_TIMEOUT in the configuration of the server. 
* autoCleanUrls
	 * When autoCleanUrls is true the autoclean parameter is added to the generated url or token. This will clean the file 
     from the Transfer Server folder after downloading. In combination with signedUrls this means that the download is valid 
     only once.

When the signedUrls option is given Transfer Server URLs are returned like:

`http://123.123.123.123/transferindex.php?token=<generated_token>`

Uploading files can also be executed with a signed URL. First you need to call the transfer index with the following
parameter (with a valid Enterprise Server ticket):

`http://123.123.123.123/transferindex.php?uploadtokens=<number_of_upload_tokens>`

Unique tokens are then generated and returned as a JSON encoded array. The token already contains a unique fileguid 
parameter so there is no need to generate this guid in the client. The files can then be uploaded by calling the 
following URL (no need for a ticket):

`PUT ../transferindex.php?token=<token>`

The same URL can then be used as FileURL when calling the Enterprise Server services.

## Deleting files

The separation of messages and file transfers can have big performance gains in all kinds of situations. This heavily 
depends on the smartness of the client application. For example, suppose the client does a CreateObjects request. In 
case of DIME, one message is sent that includes the whole native file. In case the create action fails, Enterprise Server 
returns an error (for example ‘Name already exists’). Once the end-user has corrected the error, the client has to send 
the whole message again, including the native file. Instead, when the client uses the Transfer Server to upload the 
native file, it can decide to leave the already uploaded file on the Transfer Folder when such an error occurs. This 
time, it just sends the user changed metadata again (to correct the error), while it leaves the native file untouched. 
This saves a lot of transfer/waiting time. After the CreateObjects service request is handled successfully, it sends a 
HTTP DELETE request to the Transfer Server to delete the uploaded file from the temporary Transfer Folder. Doing so, 
the file GUID is passed like this:

`http://123.123.123.123/transferindex.php?fileguid=<GUID>&ticket=<TICKET>`

It is the client application’s responsibility to clean files in the Transfer Folder. When there are files left behind, 
it is considered to be a client bug. In very exceptional situations, such as client crashes, there could be files left 
behind though. For those cases an Enterprise Server Job can be used to clean up the Transfer Folder. Nevertheless, 
clients should not rely on this feature since the folder might then rapidly grow, especially for large systems with 
many users.

## Sequence diagram

Clients sending requests with file uploads first do the uploads and then the request. On download, they wait for the 
response and then start the download. The diagram below shows the interactions between client and server. Note that at 
the very end, the client cleans the files on the file transfer server. The reason why the server should not do this for 
the uploaded files is that when the request fails due to business logics (for example no access rights), the client could 
leave the files as-is, and try again with different parameters (for example a user choosing another Category). And, it 
enables clients to build async solutions in future too.

![]({{ site.baseurl }}{% link web-services-guide/images/image8.png %})

## Connector interface classes

To support the new transfer methods changes had to made to the connector interfaces.

**_Preview\_EnterpriseConnector class:_**
* before v8: generatePreview( **\$format, \$buffer**, \$max, &\$previewFormat, &\$meta, \$bizMetaDataPreview )
* since v8: generatePreview( **Attachment \$attachment**, \$max, &\$previewFormat, &\$meta, \$bizMetaDataPreview )

**_MetaData\_EnterpriseConnector class:_**
* before v8: readMetaData( **\$format, \$buffer**, \$bizMetaDataPreview )
* since v8: readMetaData( **Attachment \$attachment**, \$bizMetaDataPreview )

Plugins implementing these connectors have to be changed and must respect the new function parameters.

## How to handle attachments within your server plug-ins

As content is no longer directly stored within the attachment object, new functions are made available to read and write 
content. These functions are provided by the BizTransferServer.class.php module (located in &lt;Enterprise&gt;/server/bizclasses/). 
To call these functions, a BizTransferServer instance must be created first. As stated before, these functions can be 
used regardless the file transfer method.

Examples:

***read attachment:***
```php
require_once BASEDIR . '/server/bizclasses/BizTransferServer.class.php'
$transferServer = new BizTransferServer();
$content = $transferServer->getContent( $attachment );
```
***write attachment:***
```php
require_once BASEDIR.'/server/bizclasses/BizTransferServer.class.php';
$attachment = new Attachment(‘native’, 'image/jpeg');
$transferServer = new BizTransferServer();
$transferServer->writeContentToFileTransferServer( $content, $attachment );
```
## Handshake

“Do you speak English?”. That question is heard at touristic places quite often. But what answer do you expect from 
people who do not speak English at all? Introducing JSON brings similar challenges; How can a client start 
talking to a server without knowing what server it is talking to and what protocols it understands? This challenge is 
new with v8; Before, only SOAP and DIME were supported. But now, the listed servers (configured in WWSettings.xml or 
configserver.php) need to be accessed with care, before clients start talking new protocols. Clients have no idea what 
server version they start talking to since they can not look into the future.

### Choosing the best protocol and file transfer

To find out, there is a very lightweight handshake done between client an server. The client fires an empty HTTP 
request to the entry point with a new handshake parameter. For example this is what a client sends to the workflow 
entry point:

`http://123.123.123.123/index.php?handshake=v1`

This tells that the client understands (version 1 of) the handshake. Enterprise Server 7 does not support handshakes 
and returns the logon page (HTML). This is not XML, so the client can safely assume DIME over SOAP needs to be chosen. 
When the client does not support it, it should raise an error that it is not compatible with the selected server.

Enterprise Server 8 (and later) will return a home brewed XML structure like this:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<EnterpriseHandshake version="1">
	<Techniques>
		<Technique protocol="SOAP" transfer="HTTP"/>
		<Technique protocol="JSON" transfer="HTTP"/>
		<Technique protocol="SOAP" transfer="DIME"/>
	</Techniques>
	<Interfaces minVersion="7" maxVersion="8">
		<Interface name="Administration" type="core"/>
		<Interface name="AdminDataSource" type="core"/>
		<Interface name="DataSource" type="core"/>
		<Interface name="Planning" type="core"/>
		<Interface name="Publishing" type="core"/>
		<Interface name="Workflow" type="core"/>
	</Interfaces>
</EnterpriseHandshake>
```

This tells the client that:
* JSON can be combined with HTTP, but not with DIME
* SOAP can be combined with HTTP or DIME
* SOAP over HTTP is preferred above SOAP over DIME

The client knows what protocols and transfers it supports (by itself) and now picks the best match that is most 
preferred by the server. Now it reconnects to the entry point again to let server know its choice, for example:

`http://123.123.123.123/index.php?protocol=JSON&transfer=HTTP`

When the client does not connect this way (leaving out the protocol and transfer parameters), the server assumes the 
client is v7 (or older) and starts using DIME over SOAP for backwards compatibility reasons.

For each request, the client may choose other parameters. For example, it might support JSON, but still does SOAP for 
some specific services that have not been ported to JSON yet.

Note that the parameters can be applied to all public interfaces: workflow, planning, administration, datasource, 
datasource admin and publish. Internal application interfaces support SOAP only.

In theory, for each interface used by clients, there should be a handshake. However, there is no reason to support 
other protocols (for one or the other) from a server point of view. Clients may reuse the returned handshake data 
assuming it is the same for all interfaces.

### Listing the configured servers

First, the list of servers needs to be determined. When there are one or more &lt;SCEnt:ServerInfo&gt; elements 
below the &lt;SCEnt:Servers&gt; element, it means that the list of servers is configured client side (WWSettings.xml) 
and so they are shown at login dialog right away without server interaction.

But, when there is one &lt;SCEnt:ServerInfo&gt; element -directly- below the &lt;Settings&gt; element in the 
WWSettings.xml file, it means that the list of servers is configured server side (configserver.php). Before talking to 
the server, clients do a handshake. This determines the protocol and the file transfer technique. When that is known, 
the client calls the server through a GetServers service to get the list of server to show in the login dialog.

Now the user picks one of the listed servers and attempts to log in. Before talking to the selected server, clients 
do a handshake. After choosing the best protocol and file transfer, clients set the protocol and transfer parameters 
to the URL and fire a LogOn request.

### Sequence diagram: server-side config

When servers are configured server-side, this is the sequence dialog of the handshake:

![]({{ site.baseurl }}{% link web-services-guide/images/image9.png %})

Because there can be a mix of server versions, clients needs to do the second handshake too; It could be the case 
there is a v8 server listing a v7 server or the other way around.

### Sequence diagram: client-side config

When servers are configured client-side, this is the sequence dialog of the handshake:

![]({{ site.baseurl }}{% link web-services-guide/images/image10.png %})

## Migration of Enterprise 7 integrations

Changes made to Enterprise Server 8 are done with care; The impact to clients and Server Plug-ins is reduced as much 
as possible. Nevertheless, SOAP clients are encouraged to migrate and Server Plug-ins (that are dealing with file 
attachments) are forced to migrate.

### SOAP clients

Although DIME is still supported for backwards compatibility reasons, SOAP clients are strongly encouraged to move 
along with the server and start using the File Transfer Server. Note that DIME might get dropped with v9.

### Server Plug-ins

To reduce memory consumption, the way file content is passed on through your Server Plug-ins has been adapted (by 
Enterprise Server). You need to adjust your plug-ins only when they use the Attachment or SOAP\_Attachment data objects. 
The SOAP\_Attachment is no longer used. The Attachment has no longer the Content element set (carrying the whole file in 
memory). There is a new element named FilePath from where you can read. Best is to leave the file on disk. Or else, 
try to read chunk-wise to avoid memory consumption. Reading the whole file in memory should be avoided, especially 
for native file renditions.
