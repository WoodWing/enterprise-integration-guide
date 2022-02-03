---
layout: chapter
title: autoAddPlacedAssetsImageToStudio
sortid: 68
permalink: 1162-autoAddPlacedAssetsImageToStudio
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
StudioPreference.autoAddPlacedAssetsImageToStudio;
```

### Access

*read/write*

### Parameters

**Return value** *boolean*

## Description

*(Applies only when using an integration with Assets)* The `autoAddPlacedAssetsImageToStudio` property defines if an image that is placed from Assets should be automatically turned into an object in Studio.

The default value is 'true'.

## Examples

**Turn on the "Automatically Add Placed Assets Image To Studio" preference**

```javascript
app.studioPreferences.autoAddPlacedAssetsImageToStudio = true;
```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2019       |           |
| 2020          | v15.2+ ✔  |
| 2021          | ✔         |
| 2022          | ✔         |
