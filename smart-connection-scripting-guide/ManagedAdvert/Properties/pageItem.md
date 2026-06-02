---
layout: chapter
title: pageItem
sortid: 48
permalink: 1129-pageItem
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedAdvert.pageItem;
```

### Access

_readonly_

### Parameters

**Return value** _PageItem_

The InDesign PageItem object associated with the ManagedAdvert.

## Description

The `pageItem` property returns the InDesign PageItem object that contains the ManagedAdvert on the layout.

## Examples

**Get the page item of the first managed advert**

```javascript
// Get the page item of the first managed advert in the active document.
var adverts = app.activeDocument.managedAdverts;
if (adverts.count() > 0) {
    var advert = adverts[0];
    var pageItem = advert.pageItem;
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
