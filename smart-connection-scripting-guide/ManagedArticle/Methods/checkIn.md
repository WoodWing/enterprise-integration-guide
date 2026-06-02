---
layout: chapter
title: checkIn
sortid: 51
permalink: 1135-checkIn
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.checkIn([pageItems]);
```

### Parameters

**pageItems** _PageItem[] (Optional)_

Page items that will be additionally added to the Article on check-in.

**Return value**

The `checkIn()` method does not return a value.

## Description

The `checkIn()` method checks in the placed Article to Studio Server.

## Examples

**Check in the first managed article**

```javascript
// Check in the first managed article in the active document.
var articles = app.activeDocument.managedArticles;
if (articles.count() > 0) {
    articles[0].checkIn();
}
```

**Check in and add an additional page item using the optional pageItems parameter**

```javascript
// Check in the first managed article and add the currently selected page item to it.
var articles = app.activeDocument.managedArticles;
if (articles.count() > 0) {
    articles[0].checkIn([app.selection[0]]);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
