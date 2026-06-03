---
layout: chapter
title: documentPaneFontSize
sortid: 68
permalink: 1162-documentPaneFontSize
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

```javascript
StudioPreference.documentPaneFontSize;
```

### Access

_read/write_

### Parameters

**Return value** _PaneFontSizeOptions_

A PaneFontSizeOptions enum value (see below).

## Description

The `documentPaneFontSize` property defines the font size for the text in the Document pane of the Studio panel.

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
// Read the current Document pane font size.
var pref = app.studioPreferences.documentPaneFontSize;
alert("Document pane font size: " + pref);
```

**Set the Document pane font size to Small**

```javascript
// Use the small font size in the Document pane.
app.studioPreferences.documentPaneFontSize = PaneFontSizeOptions.SMALL;
```

**Set the Document pane font size to Medium**

```javascript
// Use the medium font size in the Document pane.
app.studioPreferences.documentPaneFontSize = PaneFontSizeOptions.MEDIUM;
```

**Set the Document pane font size to Large**

```javascript
// Use the large font size in the Document pane.
app.studioPreferences.documentPaneFontSize = PaneFontSizeOptions.LARGE;
```

**Set the Document pane font size to Extra Large**

```javascript
// Use the extra large font size in the Document pane.
app.studioPreferences.documentPaneFontSize = PaneFontSizeOptions.EXTRA_LARGE;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
