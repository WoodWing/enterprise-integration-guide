---
layout: chapter
title: placeObject
sortid: 72
permalink: 1234-placeObject
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.placeObject(id [, componentId] [, fileType]);
```

### Parameters

**id** _string_

The object’s id

**componentId** _string_ (Optional)

The component’s id

**fileType** _string_ (Optional)

The object’s type.

**Return value**

The `placeObject()` method does not return anything.

## Description

The `placeObject()` method places a Studio or Enterprise Server object in the target object. The contentType of the target object must match the source object’s. For images, ads, layout modules and image article components the contentType must be _ContentType.GRAPHIC_TYPE_. For text article components the contentType must be _ContentType.TEXT_TYPE_.
When placing articles, either the component id must be given of the article component, or the article must be a single component article; else the place will fail.

## Examples

**Example title**

```javascript

```

## Support versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
