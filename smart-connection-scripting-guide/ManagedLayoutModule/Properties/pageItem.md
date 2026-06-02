---
layout: chapter
title: pageItem
sortid: 69
permalink: 1164-pageItem
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedLayoutModule.pageItem;
```

### Access

_readonly_

### Parameters

**Return value** _PageItem_

The InDesign PageItem object associated with the ManagedLayoutModule.

## Description

The `pageItem` property returns the InDesign PageItem object that contains the ManagedLayoutModule on the layout.

## Examples

**Get the page item of the first managed layout module**

```javascript
// Get the page item of the first managed layout module in the active document.
var modules = app.activeDocument.managedLayoutModules;
if (modules.count() > 0) {
    var module = modules[0];
    var pageItem = module.pageItem;
    alert("Page item bounds: " + pageItem.geometricBounds);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
