---
layout: chapter
title: components
sortid: 59
permalink: 1144-components
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.components;
```

### Access

_readonly_

### Parameters

**Return value** _Array_

An array of PageItem and Story objects that are the components of the managed article. Text article components are returned as Story objects; image article components are returned as PageItem objects.

## Description

The `components` property returns an array of the InDesign objects that form the components of the managed article. Each element in the array is either a PageItem (for image components) or a Story (for text components).

## Examples

**Count the components of the first managed article**

```javascript
// Get the components of the first managed article in the active document.
var articles = app.activeDocument.managedArticles;
if (articles.count() > 0) {
    var article = articles[0];
    var components = article.components;
    alert("Number of components: " + components.length);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
