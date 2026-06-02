---
layout: chapter
title: unplacedComponents
sortid: 58
permalink: 1143-unplacedComponents
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.unplacedComponents();
```

### Parameters

**Return value** _string[]_

An array of GUIDs identifying the components of the article that are not placed on the current Layout.

## Description

The `unplacedComponents()` method returns a list of GUIDs of the components that are not placed on the current Layout.

## Examples

**List the unplaced component GUIDs of the first managed article**

```javascript
// Get the unplaced component GUIDs of the first managed article.
var articles = app.activeDocument.managedArticles;
if (articles.count() > 0) {
    var guids = articles[0].unplacedComponents();
    if (guids.length > 0) {
        alert("Unplaced component GUIDs: " + guids.join(", "));
    } else {
        alert("All components are placed.");
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
