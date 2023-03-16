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

**Return value** _Array Of PageItem_

## Description

The `placeObject()` method places an article with template information on the active layer of the layout. The place action will fail when the object is not an article or does not contain template information.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2020          | ✔         |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
