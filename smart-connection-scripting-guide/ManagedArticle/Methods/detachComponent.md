---
layout: chapter
title: detachComponent
sortid: 55
permalink: 1139-detachComponent
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.detachComponent(pageItem);
```

### Parameters

**pageItem** _PageItem, Story_

The page item or Story that needs to be removed from the multi-component Article.

**Return value**

The `detachComponent()` method does not return a value.

## Description

The `detachComponent()` method detaches a component from the layout and deletes the component from a multi-component Article. The last placed component of the Article cannot be detached and deleted using this method. The functionality is similar to the 'Detach and Delete Component from Article' menu.

## Examples

**Detach and delete the first component of a multi-component article**

```javascript
// Detach and delete the first component from a multi-component managed article.
var articles = app.activeDocument.managedArticles;
if (articles.count() > 0) {
    var article = articles[0];
    var components = article.components;
    if (components.length > 1) {
        article.detachComponent(components[0]);
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
