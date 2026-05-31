---
layout: chapter
title: managedArticles
sortid: 17
permalink: 1095-managedArticles
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Document.managedArticles;
```

### Access

_readonly_

### Parameters

**Return value** _[ManagedArticles](../../ManagedArticles/index.md)_

The collection of managed articles in the Document.

## Description

The `managedArticles` property returns a [ManagedArticles](../../ManagedArticles/index.md) collection object containing all articles in the Document that are managed by Studio Server.

## Examples

**Count the managed articles in the active document**

```javascript
// Get the number of managed articles in the active document.
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

## See also

- [ManagedArticles](../../ManagedArticles/index.md)
