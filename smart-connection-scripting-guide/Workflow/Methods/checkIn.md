---
layout: chapter
title: checkIn
sortid: 101
permalink: 1173-checkIn
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.checkIn();
```

### Parameters

**Return value**

The `checkIn()` method does not return a value.

## Description

The `checkIn()` method checks the active document in to Studio Server, releasing the check-out lock. The document must already be saved as a Studio Server object before calling this method. Throws an exception in case of an error.

Use the `”Type”` key in the [entMetaData](../../Document/Properties/entMetaData.md) to indicate what kind of object should be checked in. Possible values are: `”Layout”`, `”LayoutTemplate”`, `”LayoutModule”` or `”LayoutModuleTemplate”`.

## Examples

**Check in the active document**

```javascript
// Check in the active document to Studio Server.
try {
  app.activeDocument.entWorkflow.checkIn();
  alert(“Document checked in successfully.”);
} catch (e) {
  alert(“Check in failed: “ + e.message);
}
```

**Update metadata and check in**

```javascript
// Update the status metadata and then check in the document.
var doc = app.activeDocument;
doc.entMetaData.set(“Status”, “Ready for review”);
try {
  doc.entWorkflow.checkIn();
} catch (e) {
  alert(“Check in failed: “ + e.message);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
