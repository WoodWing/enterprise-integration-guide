---
layout: chapter
title: editions
sortid: 75
permalink: 1236-editions
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.editions;
```

### Access

_read/write_

### Parameters

**Return value** _string[]_

An array of Edition names assigned to the page item.

## Description

The `editions` property gets or sets the editions assigned to the page item. When assigning to a text frame, all linked text frames will get the same set of editions assigned.

## Examples

**Get the editions of a page item**

```javascript
// Get the editions assigned to the first page item on the first page.
var pageItem = app.activeDocument.pages[0].pageItems[0];
var editions = pageItem.editions;
alert("Editions: " + editions.join(", "));
```

**Set the editions of a page item**

```javascript
// Assign editions to the first page item on the first page.
var pageItem = app.activeDocument.pages[0].pageItems[0];
pageItem.editions = ["North", "South"];
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
