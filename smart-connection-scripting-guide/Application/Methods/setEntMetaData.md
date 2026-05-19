---
layout: chapter
title: setEntMetaData
sortid: 12
permalink: 1082-setEntMetaData
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.setEntMetaData(metaData);
```

### Parameters

**metaData** [_EntMetaData_](../../EntMetaData/index.md)

Metadata of the object to set properties for on Studio Server.

**Return value** _int32_

The status returned from Studio Server

## Description

The `setEntMetaData()` method sets metadata properties for an object stored in Studio Server. The object identifier of the Studio Server object is included in the [EntMetaData](../../EntMetaData/index.md) object. The method throws an exception in case of an error.

Limitations:

- The method will only be successful if the object is not locked by the current user or another user.

- Only properties that are configured for the Set Properties dialog can be changed using the scripting method.

## Examples

**Set metadata properties for an object by its ID**

```javascript
// Get metadata of object '19083' and change the 'Cities' custom property of type multilist.
var objID = "19083";
var key = "C_CITIES";

try {
  var meta = app.getEntMetaData(objID);
  meta.set(key, ["Paris", "Berlin"]);
  app.setEntMetaData(meta);
} catch (e) {
  alert("Setting metadata properties for [" + key + "] failed: [" + e.message + "].");
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
