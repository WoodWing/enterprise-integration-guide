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
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |
| 2021          | ✔         |