---
layout: chapter
title: updateCaptionAndCredit
sortid: 73
permalink: 1168-updateCaptionAndCredit
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.updateCaptionAndCredit();
```

### Parameters

**Return value**

The `updateCaptionAndCredit()` method does not return a value.

## Description

The `updateCaptionAndCredit()` method updates the caption and/or credit information of Smart Images.

If the page item is a Smart Image, both Credit and Caption will be updated (when not locked).

If the page item is a Credit frame of a Smart Image, its credit information will be updated (when not locked).

If the page item is a Caption frame of a Smart Image, its caption information will be updated (when not locked).

## Examples

**Update caption and credit on various frame types**

```javascript
try {
    var myDoc = app.documents.item(0);
    // Update the Caption and Credit on an image item.
    var myGraphic = myDoc.allGraphics[0];
    myGraphic.updateCaptionAndCredit();
    // Update the Caption and Credit on a spline item.
    var myFrame = myDoc.pageItems.item(0);
    myFrame.updateCaptionAndCredit();
    // Update the Caption of a spline item.
    var myCaptionFrame = myDoc.pageItems.item(1);
    myCaptionFrame.updateCaptionAndCredit();
    // Update the Credit of a spline item.
    var myCreditFrame = myDoc.pageItems.item(2);
    myCreditFrame.updateCaptionAndCredit();
} catch (e) {
    alert("error " + e.number + ": " + e.description);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
