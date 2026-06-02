---
layout: chapter
title: managedImage
sortid: 79
permalink: 1171-managedImage
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.managedImage;
```

### Access

_readonly_

### Parameters

**Return value** _[ManagedImage](../../ManagedImage/index.md)_

The associated ManagedImage object, or `undefined` if none is associated.

## Description

The `managedImage` property returns the [ManagedImage](../../ManagedImage/index.md) object associated with this page item, or `undefined` if the page item is not bound to a managed image on Studio Server.

## Examples

**Check whether a page item is a managed image**

```javascript
// Check whether the first page item on the first page is a managed image.
var pageItem = app.activeDocument.pages[0].pageItems[0];
var image = pageItem.managedImage;
if (image) {
    var name = image.entMetaData.get("Core_Name");
    alert("Managed image: " + name);
} else {
    alert("Page item is not a managed image.");
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

- [ManagedImage](../../ManagedImage/index.md)
