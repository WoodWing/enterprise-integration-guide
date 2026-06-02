---
layout: chapter
title: checkOut
sortid: 64
permalink: 1402-checkOut
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedImage.checkOut();
```

### Parameters

**Return value**

The `checkOut()` method does not return a value.

## Description

The `checkOut()` method checks out the placed image for editing outside of InDesign.

Note 1: The InDesign user interface is not capable of handling/showing checked out images. It is e.g. not possible to check out and check in images by using the interface, besides during an Edit Original operation. We advise to not use this function.

Note 2: After using this call you are also responsible to call `checkIn()` to check the image back in.

## Examples

**Check out then check in a managed image**

```javascript
// Check out the first managed image, then check it back in.
var images = app.activeDocument.managedImages;
if (images.count() > 0) {
    var image = images[0];
    var name = image.entMetaData.get("Core_Name");
    alert("Checking out image: " + name);
    image.checkOut();
    // Update the image file externally, then check it back in.
    image.checkIn();
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          |           |
| 2024          | 19.0.1+ ✔ |
| 2025          | ✔         |
| 2026          | ✔         |
