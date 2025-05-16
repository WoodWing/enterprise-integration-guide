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

## Description

The `showImportOptionsDialogOnPlace` property defines if the Import options dialog should be shown when an image is placed.

The default value is 'false'.

## Examples

**Turn on the "Show Import Options Dialog on Place" preference**

```javascript
app.studioPreferences.showImportOptionsDialogOnPlace = true;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
