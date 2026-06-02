---
layout: chapter
title: managedArticle
sortid: 78
permalink: 1170-managedArticle
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.managedArticle;
```

### Access

_readonly_

### Parameters

**Return value** _[ManagedArticle](../../ManagedArticle/index.md)_

The associated ManagedArticle object, or `undefined` if none is associated.

## Description

The `managedArticle` property returns the [ManagedArticle](../../ManagedArticle/index.md) object associated with this page item, or `undefined` if the page item is not bound to a managed article on Studio Server.

## Examples

**Check whether a page item is a managed article component**

```javascript
// Check whether the first page item on the first page is a managed article component.
var pageItem = app.activeDocument.pages[0].pageItems[0];
var article = pageItem.managedArticle;
if (article) {
    var name = article.entMetaData.get("Core_Name");
    alert("Managed article: " + name);
} else {
    alert("Page item is not a managed article component.");
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [ManagedArticle](../../ManagedArticle/index.md)
