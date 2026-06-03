---
layout: chapter
title: previewPaneFontSize
sortid: 68
permalink: 1162-previewPaneFontSize
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

```javascript
StudioPreference.previewPaneFontSize;
```

### Access

_read/write_

### Parameters

**Return value** _PaneFontSizeOptions_

A PaneFontSizeOptions enum value (see below).

## Description

The `previewPaneFontSize` property defines the font size for the text in the Preview pane of the Studio panel.

Use one of the following options:

| Value                           | Description                   |
| ------------------------------- | ----------------------------- |
| PaneFontSizeOptions.SMALL       | Use the small font size       |
| PaneFontSizeOptions.MEDIUM      | Use the medium font size      |
| PaneFontSizeOptions.LARGE       | Use the large font size       |
| PaneFontSizeOptions.EXTRA_LARGE | Use the extra large font size |

The default value is PaneFontSizeOptions.SMALL.

## Examples

**Read the current preference**

```javascript
// Read the current Preview pane font size.
var pref = app.studioPreferences.previewPaneFontSize;
alert("Preview pane font size: " + pref);
```

**Set the Preview pane font size to Small**

```javascript
// Use the small font size in the Preview pane.
app.studioPreferences.previewPaneFontSize = PaneFontSizeOptions.SMALL;
```

**Set the Preview pane font size to Medium**

```javascript
// Use the medium font size in the Preview pane.
app.studioPreferences.previewPaneFontSize = PaneFontSizeOptions.MEDIUM;
```

**Set the Preview pane font size to Large**

```javascript
// Use the large font size in the Preview pane.
app.studioPreferences.previewPaneFontSize = PaneFontSizeOptions.LARGE;
```

**Set the Preview pane font size to Extra Large**

```javascript
// Use the extra large font size in the Preview pane.
app.studioPreferences.previewPaneFontSize = PaneFontSizeOptions.EXTRA_LARGE;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
