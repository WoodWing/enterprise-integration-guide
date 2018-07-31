---
layout: chapter
title: Elvis Proxy Server [since 10.5]
sortid: 32
permalink: 1061-elvis-proxy-server
---

A proxy server is added to the Elvis plug-in for Enterprise Server to expose the Elvis Preview API to Enterprise client 
applications. This is called the Elvis proxy server. The client may request for an Elvis image preview, which which then 
will be proxied to the Elvis Server Preview API. The client may also let the user create a crop of an image, which can be 
requested through the API as well.

Compared with the Transfer Server, using the proxy has the following advantages:
* Faster download because the proxy provides a download stream (while the Transfer Server saves the file in the Transfer Folder).
* The client application can define preview dimensions/resolution that suites the best in its UI.
* Provides 'stable' URLs, which have the following advantages:
  * The client application can share the download URL with other clients or users.
  * The preview URLs can be embedded in a text document.
  * Enables usage of the web browser cache to avoid downloading the same preview over and over again.
* The same API can be used to make image crops.
* Support for the `ETag` HTTP header to avoid preview download when client application has latest version already. 
(In this header the client can provide the current version number and the server will return HTTP 304 without file when 
it is the latest version, or HTTP 200 with file if there is a newer version.)

The responsibilities of the proxy server are:
* Check the Enterprise ticket and authorize the Enterprise user.
* Validate file access to the image in Enterprise.
* Setup a trust connection with Elvis and authorize the Elvis user.
* Provide stable URLs to support web browser cache.
* Expose the Elvis API to the client, but hide the Elvis location (base URL).
* Resolve the Elvis asset id from an Enterprise object id.
* Stream the image preview (or crop) back to the waiting CS app.

The Elvis proxy server is shipped with the Elvis server plug-in for Enterprise Server. This plug-in must be activated to 
be able to use the proxy. The proxy takes a HTTP GET request and composes an REST request for Elvis Server. The response 
is streamed back to the caller. The proxy talks to the Elvis Server that is configured with the ELVIS_URL option in the 
Enterprise/config/config_elvis.php file.

> **Note** - At the time writing this chapter, there are no client applications using the proxy server yet.

## Web service integration

This paragraph describes how a client application could integrate with the proxy.

### Determine the proxy base URL

When the client does support the Elvis proxy, it should first check the `FeatureSet` in the `LogOnResponse`:
```xml
<LogOnResponse>
    ...
    <FeatureSet>
        <Feature>
            <Key>ContentSourceProxyLinks_ELVIS</Key>
            <Value>http://localhost/Enterprise/server/plugins/Elvis/restproxyindex.php</Value>
        </Feature>
    </FeatureSet>
    ...
</LogOnResponse>
```
If the `ContentSourceProxyLinks_ELVIS` feature is found, the client may assume the Elvis plug-in is activated. 
Else, it is deactivated and the proxy should not be used.

The feature value provides the entry point of the proxy. This should be used by the client as a base URL to compose 
requests for the proxy.

### Request for preview

For example, when the user clicks an image listed in the search results, the client requests for a preview as usual, 
but now it indicates that it supports the proxy by providing the `ContentSourceProxyLinks_ELVIS` item in the `RequestInfo`:

```xml
<GetObjects>
    ...
    <IDs>
        <String>123</String>
    </IDs>
    <Lock>false</Lock>
    <Rendition>preview</Rendition>
    <RequestInfo>
        <String>ContentSourceProxyLinks_ELVIS</String>
    </RequestInfo>
    ...
</GetObjects>
```
When the image is stored in Elvis, Enterprise provides the download URL as follows:

```xml
<GetObjectsResponse>
    ...
    <Objects>
        <Object>
            <MetaData>
                <BasicMetaData>
                    <ID>123</ID>
                    ...
                    <ContentSource>ELVIS</ContentSource>
                    ...
                </BasicMetaData>
                ...
            </MetaData>
            ...
            <Files>
                <Attachment>
                    ...
                    <FileUrl xsi:nil="true"/>
                    ...
                    <ContentSourceFileLink xsi:nil="true"/>
                    <ContentSourceProxyLink>http://localhost/Enterprise/server/plugins/Elvis/restproxyindex.php?...</ContentSourceProxyLink>
                    ...
                </Attachment>
            </Files>
        </Object>
    </Objects>
</GetObjectsResponse>
```

### Migration from direct links to proxy links
When the client application is migrating `ContentSourceFileLink` to `ContentSourceProxyLink_ELVIS` and finds both 
options in the `LogOnResponse`, it should provide only the `ContentSourceProxyLink_ELVIS` option in `RequestInfo` of 
the `GetObjects` request. 

## Proxy API

This paragraph describes the API provided by Elvis proxy server.

### Request parameters

Parameter       | Meaning 
---------------:|:----------------
ticket          | *[Optional]* The Enterprise ticket obtained through the LogOn service response. Either the `ticket` or the `ww-app` parameter is required. When the client does not support cookies, this parameter can be used, but since the ticket often changes, the URLs won't be 'stable' <sup>1)</sup>. 
ww-app          | *[Optional]* The client application name that was provided in the LogOn service request. Either the `ticket` or the `ww-app` parameter is required. This parameter can be used instead of the 'ticket' parameter to have 'stable' URLs <sup>1)</sup>. Note that when the client does not run in a web browser it should round-trip web cookies by itself. 
objectid        | *[Required]* The ID of the workflow object in Enterprise. The object may reside in workflow or trash can.
rendition       | *[Required]* The file rendition to download. Supported values: 'native', 'preview' or 'thumb'.
preview-args    | *[Optional]* The preview- or cropping dimensions. See [Elvis Preview API](https://helpcenter.woodwing.com/hc/en-us/articles/115002690026) for details.

1) Note that 'stable' URLs have the following advantages:
* Support for the web browser's cache.
* Can be exchanged between users or client applications.
* Can be embedded in a document.

### HTTP return codes
The following HTTP codes may be returned:
* HTTP 200: The file is found and is streamed back to caller.
* HTTP 400: Bad HTTP parameters provided by caller. See above for required parameters.
* HTTP 401: When ticket is no longer valid. This should be detected by the client to do a re-login.
* HTTP 403: The user has no Read access to the invoked object in Enterprise or Elvis.
* HTTP 404: The object could not be found in Enterprise or Elvis.
* HTTP 405: Bad HTTP method requested by caller. Only GET, POST and OPTIONS are supported.
* HTTP 500: Unexpected server error.

## Preview example
When the `Foo Bar` client wants an Elvis image preview for object id `123`, the proxy can be called as follows:
```
http://localhost/Enterprise/server/plugins/Elvis/restproxyindex.php?ww-app=Foo%20Bar&objectid=123&rendition=preview&preview-args=maxWidth_600_maxHeight_400.jpg
```

The proxy will then resolve the Elvis Server URL, resolve the asset id from the object id and authorise the connection 
with Elvis credentials. In the example, the URL could be composed as follows:
```
http://localhost:18800/preview/6uk-q7GeKiD9yTAgKPsu6F/previews/maxWidth_600_maxHeight_400.jpg
```

In this example the Enterprise object id `123` is a shadow object for Elvis asset id `6uk-q7GeKiD9yTAgKPsu6F`.

## Crop example
When the `Foo Bar` client wants an Elvis image preview for object id `123`, the proxy can be called as follows:
```
http://localhost/Enterprise/server/plugins/Elvis/restproxyindex.php?ww-app=Foo%20Bar&objectid=123&rendition=preview&preview-args=cropWidth_590_cropHeight_390_cropOffsetX_10_cropOffsetY_10.jpg
```

In this example, the result is the same as for the preview example above, but now a border of 10 pixels is removed (cropped).
