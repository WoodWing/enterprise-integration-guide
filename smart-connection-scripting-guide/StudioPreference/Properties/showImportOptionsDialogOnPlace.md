---
layout: chapter
title: showImportOptionsDialogOnPlace
sortid: 68
permalink: 1162-showImportOptionsDialogOnPlace
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

```javascript
StudioPreference.showImportOptionsDialogOnPlace;
```

### Access

_read/write_

### Parameters

**Return value** _boolean_

`true` if the Import options dialog is shown when an image is placed, `false` if it is not.

## Description

The `showImportOptionsDialogOnPlace` property defines if the Import options dialog should be shown when an image is placed.

The default value is `false`.

## Examples

**Read the current preference**

```javascript
// Read whether the Import options dialog is shown on place.
var pref = app.studioPreferences.showImportOptionsDialogOnPlace;
alert("Show import options: " + pref);
```

**Show the Import options dialog when placing an image**

```javascript
// Show the Import options dialog each time an image is placed.
app.studioPreferences.showImportOptionsDialogOnPlace = true;
```

**Do not show the Import options dialog when placing an image**

```javascript
// Place images without showing the Import options dialog.
app.studioPreferences.showImportOptionsDialogOnPlace = false;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
