---
layout: chapter
title: placeObject
sortid: 102
permalink: 1175-placeObject
---
## Syntax

![](../../images/indesign.png "InDesign") ![](../../images/indesignserver.png "InDesign Server")
```javascript
Workflow.placeObject(id, where, position);
```

### Parameters

**id** *String*

The object’s id.

**where** *Page or Spread*

The page or spread to place the article on.

**position** *Array of 2 Units*

 The left top starting point used for placing the article’s template, in the form (top, left). The origin of the place is the top left corner of the page or spread object given.

**Return value** *Array Of PageItem*

## Description

The `placeObject()` method places an article with template information on the active layer of the layout. The place action will fail when the object is not an article or does not contain template information.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC            | ✔         |
| CC 2014       | ✔         |
| CC 2015       | ✔         |
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |