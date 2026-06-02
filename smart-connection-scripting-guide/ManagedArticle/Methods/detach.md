---
layout: chapter
title: detach
sortid: 54
permalink: 1138-detach
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.detach();
```

### Parameters

**Return value**

The `detach()` method does not return a value.

## Description

The `detach()` method detaches the Article from the Layout, breaking the connection to Studio Server while leaving the content on the page.

## Examples

**Detach the first managed article from the layout**

```javascript
// Detach the first managed article in the active document.
var articles = app.activeDocument.managedArticles;
if (articles.count() > 0) {
    articles[0].detach();
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
