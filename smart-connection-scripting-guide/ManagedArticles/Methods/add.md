---
layout: chapter
title: add
sortid: 61
permalink: 1148-add
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticles.add();
```

### Parameters

**Return value** _[ManagedArticle](../../ManagedArticle/index.md)_

The newly created ManagedArticle scripting object.

## Description

The `add()` method creates a new [ManagedArticle](../../ManagedArticle/index.md) scripting object and adds it to the ManagedArticles collection. The Article is not yet created on Studio Server at this point. Call `create()` on the returned ManagedArticle object to save it to Studio Server.

## Examples

**Add a new ManagedArticle and create it on Studio Server**

```javascript
// Add a ManagedArticle scripting object, set its metadata, then create it on Studio Server.
var article = app.activeDocument.managedArticles.add();
article.entMetaData.set("Core_Name", "My Article");
article.entMetaData.set("Core_Publication", "WW News");
article.create([app.selection[0]]);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [ManagedArticle.create()](../../ManagedArticle/Methods/create.md)
