---
layout: chapter
title: Download files directly from Content Source [since 9.7]
sortid: 090
permalink: doc1045
---

In Enterprise 9.7, improvements have been made in order to make communications with external file sources faster. 
It allows for clients to request direct file links to a Content Source, with which they can download file content 
directly from the Content Source, instead of it having to go through Enterprise Server first.

This omits Enterprise Server having to download the file content from the Content Source to a temporary folder and 
sending it to the requestor through DIME or Transfer Server.

In order to facilitate this new feature, the *GetObjects* service has been expanded with two extra options:
* ***RequestInfo*** has been expanded with a *ContentSourceFileLinks* option. Setting this option tells Enterprise Server 
that direct content source file links are requested by the client.
* ***SupportedContentSources*** has been added as a property. It contains a list of Content Sources that the requestor 
can directly access in order to download the file content.\
Note: If the requested object does not match any of the content sources given here, Enterprise will default to the old 
behaviour.

Aside from this, the *Attachment* element has a new *ContentSourceFileLink* property. This property may contain a 
direct link to the Content Source file when this has been requested.

Below is an example using Elvis as the Content Source. Requesting an object that originates from Elvis can be done as follows:

```xml
<GetObjectsRequest>
	...
	<RequestInfo>ContentSourceFileLinks</RequestInfo>
	...
	<SupportedContentSources>ELVIS</SupportedContentSources>
	...
</GetObjectsRequest>
```

Which returns a response like the following:

```xml
<GetObjectsResponse>
	<Objects>
		<Object>
			...
			<Files>
				<Attachment>
					...
					<FileUrl xsi:nil="true"/>
					...
					<ContentSourceFileLink>http://...</ContentSourceFileLink>
					...
				</Attachment>
				...
			</Files>
			...
		</Object>
	<Objects>
</GetObjectsResponse>
```

When talking to an older version of Enterprise Server or when the direct download feature is not supported by the 
Content Source, the returned *ContentSourceFileLink* is set to nil. In that case, the client should fall back to the 
*FileUrl* or *Content* elements instead to download the file via resp. the File Transfer Server or Enterprise Server (DIME).
