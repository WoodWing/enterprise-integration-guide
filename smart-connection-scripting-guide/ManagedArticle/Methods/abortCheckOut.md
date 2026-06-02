---
layout: chapter
title: abortCheckOut
sortid: 50
permalink: 1134-abortCheckOut
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.abortCheckOut();
```

### Parameters

**Return value**

The `abortCheckOut()` method does not return a value.

## Description

The `abortCheckOut()` method cancels the check-out of the placed Article, discarding any changes and returning it to its previous state.

## Examples

**Cancel the check-out of the first managed article**

```javascript
// Cancel the check-out of the first managed article in the active document.
var articles = app.activeDocument.managedArticles;
if (articles.count() > 0) {
    articles[0].abortCheckOut();
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
