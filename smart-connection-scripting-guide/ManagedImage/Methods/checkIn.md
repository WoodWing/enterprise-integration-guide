---
layout: chapter
title: checkIn
sortid: 63
permalink: 1154-checkIn
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedImage.checkIn();
```

### Parameters

**Return value**

The `checkIn()` method does not return anything.

## Description

The `checkIn()` method checks-in the placed Image in the Studio Server system.

## Examples

**Example title**

```javascript
var doc = app.activeDocument;
var managedImages = doc.managedImages;

var im;
var md;
var core_name;
var id;

for(i=0; i<managedImages.length; i++) {
    im = managedImages[i];
    md = im.entMetaData;
    core_name = md.get( "Core_Name");
    id = doc.entMetaData.get("Core_ID");
    alert( "image name = [" + core_name + "] ; document id = [" + id + "]");
    im.checkOut();
    alert( "Now update the image in the woodwing.noindex folder");
    im.checkIn();
}

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2021          |  	    |
| 2022          |           |
| 2023          |           |
| 2024          | 19.0.1+ ✔         |
