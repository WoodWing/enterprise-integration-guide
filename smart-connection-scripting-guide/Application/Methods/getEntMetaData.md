---
layout: chapter
title: getEntMetaData
sortid: 3
permalink: 1082-getEntMetaData
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.getEntMetaData(objectId);
```

### Parameters

**objectId** *string*

The ID of the object to obtain properties for on Studio Server.

**Return value** *EntMetaData*

The EntMetaData object containing all metadata properties of the object in Studio Server.

## Description

The `getEntMetaData()` method obtains metadata properties of an object stored in Studio Server. The method throws an exception in case of an error.

## Examples

**Example title**

```javascript
// get metadata of object '19083', change the status and set the metadata on the server object.
var objID = "19083";
var meta;
var key = "Core_Basket";
try {
    meta = app.getEntMetaData(objID);
    var objectStatus = meta.get(key);
    meta.set(key, "Layouts");
    app.setEntMetaData( meta );
}
catch(e) {
    alert("Setting metadata properties for [" + key + "] failed: [" + e.message + "].");
}
```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2019       |           |
| 2020          |           |
| 2021          |           |
| 2022          | 17.0.2+ ✔         |
