---
layout: chapter
title: entMetaData
sortid: 14
permalink: 1091-entMetaData
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Document.entMetaData;
```

### Access

_readonly_

### Parameters

**Return value** _[EntMetaData](../../EntMetaData/index.md)_

The Studio Server metadata object associated with the Document.

## Description

The `entMetaData` property returns an [EntMetaData](../../EntMetaData/index.md) object that provides access to the Studio Server metadata associated with the Document. Use this object to read metadata values such as the object ID, name, brand, issue, status, and custom properties.

## Examples

**Read metadata values of the active document**

```javascript
// Get the Studio Server metadata of the active document.
var md = app.activeDocument.entMetaData;
var name = md.get("Core_Name");
var brand = md.get("Core_Publication");
alert("Document '" + name + "' belongs to brand '" + brand + "'.");
```

**Check whether a metadata key exists**

```javascript
// Check if the document has a known Core_ID before using it.
var md = app.activeDocument.entMetaData;
if (md.has("Core_ID")) {
    var id = md.get("Core_ID");
    alert("Document ID: " + id);
} else {
    alert("Document is not managed by Studio Server.");
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [EntMetaData](../../EntMetaData/index.md)
