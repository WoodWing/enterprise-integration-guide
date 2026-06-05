---
layout: chapter
title: updateAllContent
sortid: 108
permalink: 1181-updateAllContent
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.updateAllContent();
```

### Parameters

**Return value**

The `updateAllContent()` method does not return a value.

## Description

The `updateAllContent()` method updates all placed articles and images in the active document to their latest version on Studio Server. The document must be a managed Studio Server object and the user must be logged in. Throws an exception in case of an error.

## Examples

**Update all content in the active document**

```javascript
// Update all placed articles and images to their latest version.
try {
  app.activeDocument.entWorkflow.updateAllContent();
  alert("All content updated successfully.");
} catch (e) {
  alert("Update failed: " + e.message);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
