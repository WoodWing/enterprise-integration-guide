---
layout: chapter
title: entMetaData
sortid: 60
permalink: 1145-entMetaData
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.entMetaData;
```

### Access

_readonly_

### Parameters

**Return value** _[EntMetaData](../../EntMetaData/index.md)_

The Studio Server metadata object associated with the ManagedArticle.

## Description

The `entMetaData` property returns an [EntMetaData](../../EntMetaData/index.md) object that provides access to the Studio Server metadata associated with the ManagedArticle. Use this object to read or set metadata values such as the article name, brand, issue, and status.

## Examples

**Read the name of the first managed article**

```javascript
// Get the metadata of the first managed article in the active document.
var articles = app.activeDocument.managedArticles;
if (articles.count() > 0) {
    var article = articles[0];
    var name = article.entMetaData.get("Core_Name");
    alert("Article name: " + name);
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

- [EntMetaData](../../EntMetaData/index.md)
