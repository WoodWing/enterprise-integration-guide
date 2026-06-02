---
layout: chapter
title: count
sortid: 62
permalink: 1149-count
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticles.count();
```

### Parameters

**Return value** _number_

The number of ManagedArticle objects in the collection.

## Description

The `count()` method returns the number of [ManagedArticle](../../ManagedArticle/index.md) objects within the ManagedArticles collection.

## Examples

**Count the managed articles in the active document**

```javascript
// Count the managed articles in the active document.
var count = app.activeDocument.managedArticles.count();
alert("Number of managed articles: " + count);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
