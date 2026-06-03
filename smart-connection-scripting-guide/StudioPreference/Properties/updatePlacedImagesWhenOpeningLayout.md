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

_read/write_

### Parameters

**Return value** _boolean_

`true` if Studio images are updated to their latest version when a layout is opened, `false` if they are not.

## Description

The `updatePlacedImagesWhenOpeningLayout` property defines if images stored in Studio should be updated to their latest version when a layout is opened.

The default value is `true`.

## Examples

**Read the current preference**

```javascript
// Read whether Studio images are updated when a layout is opened.
var pref = app.studioPreferences.updatePlacedImagesWhenOpeningLayout;
alert("Update images on open: " + pref);
```

**Update placed Studio images when opening a layout**

```javascript
// Automatically update placed Studio images to their latest version on layout open.
app.studioPreferences.updatePlacedImagesWhenOpeningLayout = true;
```

**Do not update placed Studio images when opening a layout**

```javascript
// Do not update placed Studio images automatically when a layout is opened.
app.studioPreferences.updatePlacedImagesWhenOpeningLayout = false;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
