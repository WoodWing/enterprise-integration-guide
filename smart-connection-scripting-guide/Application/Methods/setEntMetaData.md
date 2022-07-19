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

**metaData** *EntMetaData*

Meta data of the object to set metadata properties for.

**Return value** *int32*

The status returned from the Studio Server

## Description

The `setEntMetaData()` method sets metadata properties for an object stored in Studio Server. The object identifier of the Studio Server object is included in the EntMetaData object. The method throws an exception in case of an error.

Limitations:

* the method will only be successful if the object is not locked, by either the current user or another user.

* only properties that are configured for the Set Properties dialog can be changed using the scripting method.
    
## Examples

**Example title**

```javascript
// get metadata of object '19083', change the 'Cities' custom property of type multilist and set the metadata on the server object.
var objID = "19083";
var meta;
var key = "C_CITIES";
try {
    meta = app.getEntMetaData(objID);
    var objectStatus = meta.get(key);
    meta.set(key, ["Paris", "Berlin"]);
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
