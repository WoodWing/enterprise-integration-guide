---
layout: chapter
title: saveAs
sortid: 104
permalink: 1239-saveAs
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.saveAs();
```

### Parameters

**Return value** _[Document](../../Document/index.md)_

The Document object representing the document saved as a new Studio Server object.

## Description

The `saveAs()` method saves the active document as a new object in Studio Server. Set the desired metadata on the document via [entMetaData](../../Document/Properties/entMetaData.md) before calling `saveAs()`. Throws an exception in case of an error.

Use the `”Type”` key in the [entMetaData](../../Document/Properties/entMetaData.md) to indicate what kind of object should be created. Possible values are: `”Layout”`, `”LayoutTemplate”`, `”LayoutModule”` or `”LayoutModuleTemplate”`.

## Examples

**Save the active document as a new Studio Server object**

```javascript
// Set the required metadata and save the document as a new Studio Server object.
var doc = app.activeDocument;
doc.entMetaData.set("Core_Name", "New Layout Copy");
doc.entMetaData.set("Core_Publication", "WW News");
doc.entMetaData.set("Core_Basket", "Layout Draft");
try {
  var newDoc = doc.entWorkflow.saveAs();
  alert(“Saved as: “ + newDoc.name);
} catch (e) {
  alert(“Save as failed: “ + e.message);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
