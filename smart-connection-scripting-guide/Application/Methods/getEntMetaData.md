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

**objectId** _string_

The ID of the object to obtain properties for on Studio Server.

**Return value** [_EntMetaData_](../../EntMetaData/index.md)

The EntMetaData object containing all metadata properties of the object in Studio Server.

## Description

The `getEntMetaData()` method returns an [EntMetaData](../../EntMetaData/index.md) object of a Studio server object by its ID.  
The EntMetaData object can be manipulated by setting new metadata by using `setEntMetaData()`.

## Examples

**Example title**

```javascript
// Get metadata of object '19083' and change the metadata properties of the Studio server object.
var objectID = "19083";
var statusKey = "Core_Basket"; // Status
var customKey = "C_CITIES"; // Custom property

var metaDataObject = app.getEntMetaData(objectID);
var statusValue = metaDataObject.get(statusKey);
var customValue = metaDataObject.get(customKey);

metaDataObject.set(statusKey, "Layouts");
metaDataObject.set(customKey, ["Paris", "Berlin"]);
app.setEntMetaData(metaDataObject);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2021          |           |
| 2022          | 17.0.2+ ✔ |
| 2023          | ✔         |
| 2024          | ✔         |
