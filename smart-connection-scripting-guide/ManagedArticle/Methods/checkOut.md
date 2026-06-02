---
layout: chapter
title: checkOut
sortid: 52
permalink: 1136-checkOut
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.checkOut();
```

### Parameters

**Return value**

The `checkOut()` method does not return a value.

## Description

The `checkOut()` method checks out the placed Article for editing.

## Examples

**Check out the first managed article**

```javascript
// Check out the first managed article in the active document.
var articles = app.activeDocument.managedArticles;
if (articles.count() > 0) {
    articles[0].checkOut();
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
