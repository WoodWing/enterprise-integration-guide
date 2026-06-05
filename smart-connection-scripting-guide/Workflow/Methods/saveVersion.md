---
layout: chapter
title: saveVersion
sortid: 105
permalink: 1178-saveVersion
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.saveVersion();
```

### Parameters

**Return value** _[Document](../../Document/index.md)_

The Document object representing the document after saving the new version.

## Description

The `saveVersion()` method saves a new version of the active document to Studio Server without showing a metadata dialog. Any metadata changes made by the calling script are not applied; the existing server metadata is used. Throws an exception in case of an error.

## Examples

**Save a version of the active document**

```javascript
// Save a version of the active document to Studio Server.
try {
  var doc = app.activeDocument.entWorkflow.saveVersion();
  alert("Version saved: " + doc.name);
} catch (e) {
  alert("Save version failed: " + e.message);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
