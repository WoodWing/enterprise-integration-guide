---
layout: chapter
title: pageItem
sortid: 67
permalink: 1407-pageItem
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedImage.pageItem;
```

### Access

_readonly_

### Parameters

**Return value** _PageItem_

The InDesign PageItem object associated with the ManagedImage.

## Description

The `pageItem` property returns the InDesign PageItem object that contains the ManagedImage on the layout.

## Examples

**Get the page item of the first managed image**

```javascript
// Get the page item of the first managed image in the active document.
var images = app.activeDocument.managedImages;
if (images.count() > 0) {
    var image = images[0];
    var pageItem = image.pageItem;
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
