---
layout: chapter
title: managedAdvert
sortid: 77
permalink: 1169-managedAdvert
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.managedAdvert;
```

### Access

_readonly_

### Parameters

**Return value** _[ManagedAdvert](../../ManagedAdvert/index.md)_

The associated ManagedAdvert object, or `undefined` if none is associated.

## Description

The `managedAdvert` property returns the [ManagedAdvert](../../ManagedAdvert/index.md) object associated with this page item, or `undefined` if the page item is not bound to a managed advert on Studio Server.

## Examples

**Check whether a page item is a managed advert**

```javascript
// Check whether the first page item on the first page is a managed advert.
var pageItem = app.activeDocument.pages[0].pageItems[0];
var advert = pageItem.managedAdvert;
if (advert) {
    var name = advert.entMetaData.get("Core_Name");
    alert("Managed advert: " + name);
} else {
    alert("Page item is not a managed advert.");
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

- [ManagedAdvert](../../ManagedAdvert/index.md)
