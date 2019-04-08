---
layout: chapter
title: updateCaptionAndCredit
sortid: 21
permalink: 1168-updateCaptionAndCredit
---
## Syntax

```javascript
PageItem.updateCaptionAndCredit();
```

### Parameters

**Return value**

The `updateCaptionAndCredit()` method does not return anything.

## Description

The `updateCaptionAndCredit()` method updates the caption and/or credit information of Smart Images.

If the Page Item is a Smart Image, both Credit and Caption will be updated (when not locked).

If the Page Item is a Credit of a Smart Image its Credit information will be updated (when not locked).

If the Page Item is a Caption of a Smart Image its Caption information will be updated (when not locked).

## Examples

**Example title**

The sample will show how to update the credit and/or caption values on specific frames.

```javascript
try
{
var myDoc = doc.documents.item(0);
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
}
catch( e)
{
desc = e.description;
num = e.number;
alert( "error " + num + ": " + desc );
}
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