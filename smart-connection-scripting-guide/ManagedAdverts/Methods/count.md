---
layout: chapter
title: count
sortid: 49
permalink: 1131-count
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedAdverts.count();
```

### Parameters

**Return value** _number_

The number of ManagedAdvert objects in the collection.

## Description

The `count()` method returns the number of [ManagedAdvert](../../ManagedAdvert/index.md) objects within the ManagedAdverts collection.

## Examples

**Count the managed adverts in the active document**

```javascript
// Count the managed adverts in the active document.
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
