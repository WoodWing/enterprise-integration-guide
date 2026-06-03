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

_read/write_

### Parameters

**Return value** _boolean_

`true` if images placed from Assets are automatically turned into Studio objects, `false` if they are not.

## Description

_(Applies only when using an integration with Assets)_ The `autoAddPlacedAssetsImageToStudio` property defines if an image that is placed from Assets should be automatically turned into an object in Studio.

The default value is `true`.

## Examples

**Read the current preference**

```javascript
// Read whether placed Assets images are automatically added to Studio.
var pref = app.studioPreferences.autoAddPlacedAssetsImageToStudio;
alert("Auto-add Assets images: " + pref);
```

**Automatically add placed Assets images to Studio**

```javascript
// Automatically turn images placed from Assets into Studio objects.
app.studioPreferences.autoAddPlacedAssetsImageToStudio = true;
```

**Do not automatically add placed Assets images to Studio**

```javascript
// Do not automatically turn images placed from Assets into Studio objects.
app.studioPreferences.autoAddPlacedAssetsImageToStudio = false;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
