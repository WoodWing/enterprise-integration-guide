---
layout: chapter
title: placeObject
sortid: 72
permalink: 1234-placeObject
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.placeObject(id [, componentId] [, objectType]);
```

### Parameters

**id** _string_

The object ID on Studio Server of the object to place.

**componentId** _string (Optional)_

The ID of the article component to place. Required when placing a multi-component article to identify which component to place in this frame.

**objectType** _string (Optional)_

The type of the object to place (for example `"Article"`, `"Image"`).

**Return value**

The `placeObject()` method does not return a value.

## Description

The `placeObject()` method places a Studio Server object in the target page item. The content type of the target frame must match the source object:

- For images, adverts, layout modules, and image article components the content type must be _ContentType.GRAPHIC_TYPE_.
- For text article components the content type must be _ContentType.TEXT_TYPE_.

When placing a multi-component article, either the `componentId` must be provided, or the article must be a single-component article; otherwise the place will fail.

## Examples

**Place an object by its Studio Server ID**

```javascript
// Place a Studio Server object in the currently selected page item.
app.selection[0].placeObject("6315");
```

**Place a specific component of a multi-component article**

```javascript
// Place a specific article component using its component ID.
app.selection[0].placeObject("6315", "ComponentID123");
```

**Place an object by specifying its type**

```javascript
// Place an image by specifying the object type.
app.selection[0].placeObject("6315", "", "Image");
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
