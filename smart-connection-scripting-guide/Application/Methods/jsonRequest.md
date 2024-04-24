---
layout: chapter
title: jsonRequest
sortid: 4
permalink: 1079-jsonRequest
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.jsonRequest(jsonUrl, jsonRequest);
```

### Parameters

**jsonUrl** _string_

The path to the Studio or Enterprise server URL which can receive and respond to requests done in JSON object string format.

**jsonRequest** _string_

The request to post to the above URL in JSON object string format.

**Return value** _string_

A string containing the complete and total server response.

## Description

The `jsonRequest()` method posts a JSON object string as a request to a Studio or Enterprise Server URL in order to receive a response in JSON object string format.

## Examples

**QueryObjects, DeleteObject, GetPublicationDate**

[jsonRequestSamples.zip](https://github.com/WoodWing/enterprise-integration-guide/raw/master/assets/download/jsonRequest-samples.zip)

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
