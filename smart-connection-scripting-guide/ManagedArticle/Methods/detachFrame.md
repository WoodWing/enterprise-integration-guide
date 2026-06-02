---
layout: chapter
title: detachFrame
sortid: 56
permalink: 1140-detachFrame
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.detachFrame(pageItems);
```

### Parameters

**pageItems** _PageItem[]_

The page items that will be detached from the article. If the passed page item is the last placed component of the Article the Error Code "The object cannot be detached." will be returned.

**Return value**

The `detachFrame()` method does not return a value.

## Description

The `detachFrame()` method detaches frames from a multi-component Article. The last placed component of the Article cannot be detached using this method. The functionality is similar to the 'Detach Component' menu.

## Examples

**Detach the first component of a multi-component article**

```javascript
// Detach the first component from a multi-component managed article.
var articles = app.activeDocument.managedArticles;
if (articles.count() > 0) {
    var article = articles[0];
    var components = article.components;
    if (components.length > 1) {
        article.detachFrame([components[0]]);
    }
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
