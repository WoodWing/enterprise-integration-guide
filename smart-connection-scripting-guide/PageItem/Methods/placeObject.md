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

**id** *string*

The object’s id

**componentId** *string* (Optional)

The component’s id

**fileType** *string* (Optional)

The object’s type. This is an optional parameter since CC 2014.

**Return value**

The `placeObject()` method does not return anything.

## Description

The `placeObject()` method places an Enterprise object in the target object. The contentType of the target object must match the source object’s. For images, ads, layout modules and image article components the contentType must be *ContentType.GRAPHIC_TYPE*. For text article components the contentType must be *ContentType.TEXT_TYPE*.
When placing articles, either the component id must be given of the article component, or the article must be a single component article; else the place will fail.

## Examples

**Example title**

```javascript

```

## Support versions

| Adobe Version | Support |
|---------------|---------|
| CC            | ✔       |
| CC 2014       | ✔       |
| CC 2015       | ✔       |
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |