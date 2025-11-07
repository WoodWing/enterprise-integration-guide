---
layout: chapter
title: enableSmartCaching
sortid: 68
permalink: 1162-enableSmartCaching
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

```javascript
StudioPreference.enableSmartCaching;
```

### Access

_read/write_

### Parameters

**Return value** _boolean_

## Description

The `enableSmartCaching` property defines if Smart Caching (automatically downloading a file onto a user's system when the file is routed to that user) should be enabled.

The default value is 'true'.

## Examples

**Enable Smart Caching**

```javascript
app.studioPreferences.enableSmartCaching = true;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
