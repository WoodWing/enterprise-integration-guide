---
layout: chapter
title: frameData
sortid: 71
permalink: 1233-frameData
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.frameData;
```

### Access

_readonly_

### Parameters

**Return value** _string_

A JSON string containing layout and position information about the frame.

## Description

The `frameData` property returns a JSON string with layout and position information about the page item frame. The returned JSON object contains the following fields:

| Field | Type | Description |
| ----- | ---- | ----------- |
| `ElementID` | string | GUID identifying the story or element |
| `FrameOrder` | number | Index of this frame in the sequence of linked frames |
| `FrameID` | number | UID of the frame |
| `Left` | number | Left position relative to the page |
| `Top` | number | Top position relative to the page |
| `Width` | number | Width of the frame |
| `Height` | number | Height of the frame |
| `Layer` | string | Name of the layer the frame is on |
| `PageSequence` | number | 1-based sequential page number in the document |
| `PageNumber` | string | Actual page number, including any section prefix |
| `Tiles` | array | Frame tile information for frames spanning multiple pages |

## Examples

**Get frame data for the first page item**

```javascript
// Get the frame data of the first page item on the first page.
var pageItem = app.activeDocument.pages[0].pageItems[0];
var data = JSON.parse(pageItem.frameData);
alert(
    "Frame at (" + data.Left + ", " + data.Top + ")" +
    " — Size: " + data.Width + " x " + data.Height +
    " on page " + data.PageNumber
);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
