---
layout: chapter
title: create
sortid: 65
permalink: 1403-create
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedImage.create(pageItem);
```

### Parameters

**pageItem** _PageItem_

The page item of which the image will be created.

**Return value**

The `create()` method does not return a value.

## Description

The `create()` method creates an image from the given page item and saves it to Studio Server.

## Examples

**Create a new image from the currently selected page item**

```javascript
// Add a ManagedImage scripting object, set its metadata, then create it on Studio Server.
var image = app.activeDocument.managedImages.add();
image.entMetaData.set("Core_Name", "My Image");
image.entMetaData.set("Core_Publication", "WW News");
image.create(app.selection[0]);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
