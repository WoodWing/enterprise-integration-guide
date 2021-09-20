---
layout: chapter
title: jsonRequest
sortid: 3
permalink: 1079-jsonRequest
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
app.jsonRequest(jsonUrl, jsonRequest);
```

### Parameters

**jsonUrl** *string*

The path to the Enterprise or Studio server URL which can receive and respond to requests done in JSON object string format.

**jsonRequest** *string*

The request to post to the above URL in JSON object string format.

**Return value** *string*

A string containing the complete and total server response.

## Description

The `jsonRequest()` method posts a JSON object string as a request to an Enterprise or Studio Server URL in order to receive a response in JSON object string format.

## Examples

**QueryObjects, DeleteObject, GetPublicationDate**

[jsonRequestSamples.zip](https://request-download.woodwing.com/v1/?path=enterprise/StudioForInDesignAndInCopy/SampleScripts/jsonRequest-samples.zip)

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |
| 2021          | ✔         |
