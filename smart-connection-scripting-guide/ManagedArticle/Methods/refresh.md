---
layout: chapter
title: refresh
sortid: 57
permalink: 1142-refresh
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.refresh();
```

### Parameters

**Return value**

The `refresh()` method does not return a value.

## Description

The `refresh()` method updates the content of the placed Article with the latest version from Studio Server.

## Examples

**Refresh the content of the first managed article**

```javascript
// Refresh the first managed article in the active document.
var articles = app.activeDocument.managedArticles;
if (articles.count() > 0) {
    articles[0].refresh();
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
