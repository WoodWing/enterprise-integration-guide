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

**Set the "Document Pane Font Size" preference to "Large"**

```javascript
app.studioPreferences.documentPaneFontSize = PaneFontSizeOptions.LARGE;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
