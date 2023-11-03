---
layout: chapter
title: woodwingLogging
sortid: 11
permalink: 1087-woodwingLogging
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.woodwingLogging;
```

### Access

_read/write_

### Parameters

**Return value** boolean

Status (true or false) of the woodwingLogging preference.

## Description

The `woodwingLogging` property turns off and on WoodWing logging.

## Examples
    
**Turn on WoodWing logging**

```javascript
    app.woodwingLogging = true;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2020          | ✔         |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
