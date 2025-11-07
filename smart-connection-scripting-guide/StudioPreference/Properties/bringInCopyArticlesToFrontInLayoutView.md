---
layout: chapter
title: bringInCopyArticlesToFrontInLayoutView
sortid: 68
permalink: 1162-bringInCopyArticlesToFrontInLayoutView
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

```javascript
StudioPreference.bringInCopyArticlesToFrontInLayoutView;
```

### Access

_read/write_

### Parameters

**Return value** _boolean_

## Description

The `bringInCopyArticlesToFrontInLayoutView` property defines if all article components of a story should be brought to the front in Layout view when an article is opened in InCopy. This makes sure that all article components are fully accessible and not obscured by other layout objects.

The default value is 'false'.

## Examples

**Turn on the "Bring InCopy Articles to Front in Layout View" preference**

```javascript
app.studioPreferences.bringInCopyArticlesToFrontInLayoutView = true;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
