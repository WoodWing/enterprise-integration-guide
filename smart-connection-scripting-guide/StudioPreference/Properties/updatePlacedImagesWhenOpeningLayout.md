---
layout: chapter
title: updatePlacedImagesWhenOpeningLayout
sortid: 68
permalink: 1162-updatePlacedImagesWhenOpeningLayout
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
StudioPreference.updatePlacedImagesWhenOpeningLayout;
```

### Access

*read/write*

### Parameters

**Return value** *boolean*

## Description

The `updatePlacedImagesWhenOpeningLayout` property defines if images stored in Studio should be updated to their latest version when a layout is opened.

The default value is 'true'.

## Examples

**Turn on the "Update Placed Studio Images When Opening a Layout" preference**

```javascript
app.studioPreferences.updatePlacedImagesWhenOpeningLayout = true;
```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2017       |           |
| CC 2018       |           |
| CC 2019       |           |
| 2020          | v15.2+ ✔  |