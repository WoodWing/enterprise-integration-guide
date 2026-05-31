---
layout: chapter
title: managedImages
sortid: 18
permalink: 1096-managedImages
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Document.managedImages;
```

### Access

_readonly_

### Parameters

**Return value** _[ManagedImages](../../ManagedImages/index.md)_

The collection of managed images in the Document.

## Description

The `managedImages` property returns a [ManagedImages](../../ManagedImages/index.md) collection object containing all images in the Document that are managed by Studio Server.

## Examples

**Count the managed images in the active document**

```javascript
// Get the number of managed images in the active document.
var count = app.activeDocument.managedImages.count();
alert("Number of managed images: " + count);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [ManagedImages](../../ManagedImages/index.md)
