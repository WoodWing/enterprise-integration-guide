---
layout: chapter
title: updatePanels
sortid: 15
permalink: 1247-updatePanels
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

```javascript
app.updatePanels();
```

### Parameters

None.

**Return value**

The `updatePanels()` method does not return a value.

## Description

The `updatePanels()` method refreshes the contents of all Studio query panels in InDesign or InCopy.

## Examples

**Refresh all query panels**

```javascript
// Refresh all Studio query panels.
app.updatePanels();
```

**Refresh panels after sending an object to its next workflow status**

```javascript
// Send an object to its next workflow status, then refresh the panels.
try {
  app.sendObjectToNext("6315");
} catch (e) {
  alert("Failed to send object to next status: " + e.message);
}
app.updatePanels();
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
