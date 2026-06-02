---
layout: chapter
title: elementLabel
sortid: 76
permalink: 1237-elementLabel
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.elementLabel;
```

### Access

_read/write_

### Parameters

**Return value** _string_

The name of the Element Label assigned to the page item.

## Description

The `elementLabel` property gets or sets the Element Label assigned to the page item. When assigning to a text frame, all threaded text frames will get the same Element Label.

## Examples

**Get the element label of a page item**

```javascript
// Get the element label of the first page item on the first page.
var pageItem = app.activeDocument.pages[0].pageItems[0];
var label = pageItem.elementLabel;
alert("Element label: " + label);
```

**Set the element label of a page item**

```javascript
// Assign an element label to the first page item on the first page.
var pageItem = app.activeDocument.pages[0].pageItems[0];
pageItem.elementLabel = "Intro";
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
