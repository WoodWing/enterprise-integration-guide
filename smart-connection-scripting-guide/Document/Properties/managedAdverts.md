---
layout: chapter
title: managedAdverts
sortid: 16
permalink: 1094-managedAdverts
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Document.managedAdverts;
```

### Access

_readonly_

### Parameters

**Return value** _[ManagedAdverts](../../ManagedAdverts/index.md)_

The collection of managed adverts in the Document.

## Description

The `managedAdverts` property returns a [ManagedAdverts](../../ManagedAdverts/index.md) collection object containing all adverts in the Document that are managed by Studio Server.

## Examples

**Count the managed adverts in the active document**

```javascript
// Get the number of managed adverts in the active document.
var count = app.activeDocument.managedAdverts.count();
alert("Number of managed adverts: " + count);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [ManagedAdverts](../../ManagedAdverts/index.md)
