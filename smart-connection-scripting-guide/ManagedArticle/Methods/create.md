---
layout: chapter
title: create
sortid: 53
permalink: 1137-create
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.create(pageItems [, stationery]);
```

### Parameters

**pageItems** _PageItem[]_

The page items that will form the Article.

**stationery** _boolean (Optional)_

If set to `true`, an Article Template will be created instead of an Article. Default is `false`.

**Return value**

The `create()` method does not return a value.

## Description

The `create()` method creates a placed Article from the given page items and saves it to Studio Server. Depending on the system configuration, the given page items can contain images which become part of the Article.

## Examples

**Create a new article from a page item**

```javascript
// Add a ManagedArticle scripting object, set its metadata, then create it on Studio Server.
var article = app.activeDocument.managedArticles.add();
article.entMetaData.set("Core_Name", "My Article");
article.entMetaData.set("Core_Publication", "WW News");
article.create([app.selection[0]]);
```

**Create an Article Template using the optional stationery parameter**

```javascript
// Create an Article Template (stationery) instead of a regular Article.
var template = app.activeDocument.managedArticles.add();
template.entMetaData.set("Core_Name", "My Article Template");
template.entMetaData.set("Core_Publication", "WW News");
template.create([app.selection[0]], true);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
