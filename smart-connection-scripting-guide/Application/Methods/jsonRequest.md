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

Full working script examples for `QueryObjects`, `DeleteObject`, `GetPublicationDate`: [jsonRequestSamples.zip](https://github.com/WoodWing/enterprise-integration-guide/raw/master/assets/download/jsonRequestSamples.zip)

**QueryObject code snippet**

```javascript
#include "json2.jsxinc" // Included in the jsonRequest-samples.zip.

var serverUrl =
  "https://studio.enterprise.woodwing.net/server/index.php?protocol=JSON";

// Construct the request.
var requestObject = {
  method: "QueryObjects",
  id: "1",
  params: [
    {
      Params: [
        {
          Property: "Publication",
          Value: "WW News",
          Operation: "=",
          __classname__: "QueryParam",
        },
        {
          Property: "Type",
          Value: "Image",
          Operation: "=",
          __classname__: "QueryParam",
        },
        {
          Property: "Name",
          Value: "Beachball",
          Operation: "contains",
          __classname__: "QueryParam",
        },
      ],
      FirstEntry: 1,
      MinimalProps: ["ID", "Name", "Type", "Category", "Issues", "State"],
      Order: [
        {
          Property: "Name",
          Direction: true,
          __classname__: "QueryOrder",
        },
      ],
      Ticket: app.entSession.activeTicket,
    },
  ],
  jsonrpc: "2.0",
};

// Execute the request and get the response.
var response = JSON.parse(
  app.jsonRequest(serverUrl, JSON.stringify(requestObject))
);

// Get the object with the requested information.
var requestedObject = response.result.Rows[0];

// Get the individual values.
var objectType = requestedObject[1];    // Images
var objectName = requestedObject[2];    // Beachball
var brandName = requestedObject[18];    // WW News
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
