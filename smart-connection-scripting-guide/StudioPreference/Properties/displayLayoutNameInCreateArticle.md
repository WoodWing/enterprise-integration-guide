---
layout: chapter
title: displayLayoutNameInCreateArticle
sortid: 68
permalink: 1162-displayLayoutNameInCreateArticle
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
StudioPreference.displayLayoutNameInCreateArticle;
```

### Access

*read/write*

### Parameters

**Return value** *boolean*

## Description

The `displayLayoutNameInCreateArticle` property defines if the name of the layout should be used as the default name for an article that is created from a frame on the layout.

The default value is 'false'.

## Examples

**Turn on the "Display Layout Name in Create Article" preference**

```javascript
app.studioPreferences.displayLayoutNameInCreateArticle = true;
```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2017       |           |
| CC 2018       |           |
| CC 2019       |           |
| 2020          | v15.2+ ✔  |