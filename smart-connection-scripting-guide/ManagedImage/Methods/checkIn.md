---
layout: chapter
title: checkIn
sortid: 63
permalink: 1401-checkIn
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedImage.checkIn([useSmartCheckIn]);
```

### Parameters

**useSmartCheckIn** _boolean (Optional)_

When `true`, only changed image files are checked in (smart check-in). When `false`, the image file is always checked in regardless of whether it changed. Default is `true`.

Should not be used in combination with the similar option of `PageItem.replaceEnterpriseImage`.

**Return value**

The `checkIn()` method does not return a value.

## Description

The `checkIn()` method checks in the placed image to Studio Server.

## Examples

**Check in all managed images in the active document**

```javascript
// Check in all managed images in the active document.
var images = app.activeDocument.managedImages;
for (var i = 0; i < images.count(); i++) {
    images[i].checkIn();
}
```

**Force check-in of all images, bypassing smart check-in**

```javascript
// Check in all managed images, always uploading the file even if unchanged.
var images = app.activeDocument.managedImages;
for (var i = 0; i < images.count(); i++) {
    images[i].checkIn(false);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          |           |
| 2024          | 19.0.1+ ✔ |
| 2025          | ✔         |
| 2026          | ✔         |
