---
layout: chapter
title: count
sortid: 28
permalink: 1111-count
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Dossiers.count();
```

### Parameters

**Return value** _number_

The number of Dossier objects in the collection.

## Description

The `count()` method returns the number of [Dossier](../../Dossier/index.md) objects currently in the Dossiers collection.

## Examples

**Get the number of dossiers in the collection**

```javascript
// Get the number of dossiers currently in the collection.
var count = app.dossiers.count();
alert("Number of dossiers: " + count);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
