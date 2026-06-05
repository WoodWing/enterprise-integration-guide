---
layout: chapter
title: placeObject
sortid: 102
permalink: 1175-placeObject
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.placeObject(id, where, position);
```

### Parameters

**id** _String_

The object’s id.

**where** _Page or Spread_

The page or spread to place the article on.

**position** _Array of 2 Units_

The left top starting point used for placing the article’s template, in the form (top, left). The origin of the place is the top left corner of the page or spread object given.

**Return value** _Array of PageItem_

The array of PageItem objects that were placed on the layout.

## Description

The `placeObject()` method places a Studio Server article with template information on the active layer of the layout. The method fails if the object is not an article or does not contain template information.

The `position` parameter defines the offset from the top-left corner of the given page or spread, in the form `[top, left]`.

## Examples

**Place an article on the first page**

```javascript
// Place the article with id "1234" on the first page at position top=30, left=30.
var doc = app.activeDocument;
var page = doc.pages.item(0);
var placed = doc.entWorkflow.placeObject("1234", page, [30, 30]);
alert("Placed " + placed.length + " page item(s).");
```

**Place an article on the first spread**

```javascript
// Place the article at the zero point of the first spread.
var doc = app.activeDocument;
var spread = doc.spreads.item(0);
var placed = doc.entWorkflow.placeObject("1234", spread, [0, 0]);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
