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

*read/write*

### Parameters

**Return value** *boolean*

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
|---------------|-----------|
| CC 2018       |           |
| CC 2019       |           |
| 2020          | v15.2+ ✔  |
| 2021          | ✔         |