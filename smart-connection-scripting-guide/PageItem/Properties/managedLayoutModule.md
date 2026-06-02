---
layout: chapter
title: managedLayoutModule
sortid: 80
permalink: 1172-managedLayoutModule
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.managedLayoutModule;
```

### Access

_readonly_

### Parameters

**Return value** _[ManagedLayoutModule](../../ManagedLayoutModule/index.md)_

The associated ManagedLayoutModule object, or `undefined` if none is associated.

## Description

The `managedLayoutModule` property returns the [ManagedLayoutModule](../../ManagedLayoutModule/index.md) object associated with this page item, or `undefined` if the page item is not bound to a managed layout module on Studio Server.

## Examples

**Check whether a page item is a managed layout module**

```javascript
// Check whether the first page item on the first page is a managed layout module.
var pageItem = app.activeDocument.pages[0].pageItems[0];
var layoutModule = pageItem.managedLayoutModule;
if (layoutModule) {
    var name = layoutModule.entMetaData.get("Core_Name");
    alert("Managed layout module: " + name);
} else {
    alert("Page item is not a managed layout module.");
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

- [ManagedLayoutModule](../../ManagedLayoutModule/index.md)
