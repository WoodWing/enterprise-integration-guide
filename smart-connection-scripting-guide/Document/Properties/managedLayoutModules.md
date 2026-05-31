---
layout: chapter
title: managedLayoutModules
sortid: 19
permalink: 1097-managedLayoutModules
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Document.managedLayoutModules;
```

### Access

_readonly_

### Parameters

**Return value** _[ManagedLayoutModules](../../ManagedLayoutModules/index.md)_

The collection of managed Layout Modules in the Document.

## Description

The `managedLayoutModules` property returns a [ManagedLayoutModules](../../ManagedLayoutModules/index.md) collection object containing all Layout Modules in the Document that are managed by Studio Server.

## Examples

**Count the managed Layout Modules in the active document**

```javascript
// Get the number of managed Layout Modules in the active document.
var count = app.activeDocument.managedLayoutModules.count();
alert("Number of managed Layout Modules: " + count);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [ManagedLayoutModules](../../ManagedLayoutModules/index.md)
