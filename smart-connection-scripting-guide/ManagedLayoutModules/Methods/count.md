---
layout: chapter
title: count
sortid: 70
permalink: 1166-count
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedLayoutModules.count();
```

### Parameters

**Return value** _number_

The number of ManagedLayoutModule objects in the collection.

## Description

The `count()` method returns the number of [ManagedLayoutModule](../../ManagedLayoutModule/index.md) objects within the ManagedLayoutModules collection.

## Examples

**Count the managed layout modules in the active document**

```javascript
// Count the managed layout modules in the active document.
var count = app.activeDocument.managedLayoutModules.count();
alert("Number of managed layout modules: " + count);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
