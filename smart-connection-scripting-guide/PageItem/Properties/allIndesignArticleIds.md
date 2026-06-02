---
layout: chapter
title: allIndesignArticleIds
sortid: 74
permalink: 1235-allIndesignArticleIds
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.allIndesignArticleIds;
```

### Access

_readonly_

### Parameters

**Return value** _string[]_

An array of IDs of all InDesign Articles to which the page item belongs.

## Description

The `allIndesignArticleIds` property returns the IDs of all InDesign Articles to which the page item belongs. The IDs of InDesign Articles that contain a parent group item of the page item are also returned. This differs from the `PageItem.allArticles` call.

## Examples

**Get the InDesign Article IDs of the first page item**

```javascript
// Get all InDesign Article IDs for the first page item on the first page.
var pageItem = app.activeDocument.pages[0].pageItems[0];
var ids = pageItem.allIndesignArticleIds;
if (ids.length > 0) {
    alert("InDesign Article IDs: " + ids.join(", "));
} else {
    alert("This page item does not belong to any InDesign Articles.");
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
