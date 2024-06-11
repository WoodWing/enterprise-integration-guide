---
layout: chapter
title: checkOut
sortid: 64
permalink: 1153-checkOut
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedImage.checkOut();
```

### Parameters

**Return value**

The `checkOut()` method does not return anything.

## Description

The `checkOut()` method checks-out the placed Image.

Note 1: The InDesign user interface is not capable of handling/showing checked out images. It is e.g. not possible to check out and check in images by using the interface, besides during an Edit Original operation. We advise to not use this function.

Note 2: After using this call you are also responsible to call checkIn to check the image back in.

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
