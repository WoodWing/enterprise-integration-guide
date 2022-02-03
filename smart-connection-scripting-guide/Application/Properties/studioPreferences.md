---
layout: chapter
title: studioPreferences
sortid: 12
permalink: 1087-studioPreferences
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
app.studioPreferences;
```

### Access

*readonly*

### Parameters

**Return value** *StudioPreference*

WoodWing Studio preference settings object.

## Description

The `studioPreferences` property gives access to the WoodWing Studio preference settings by returning a StudioPreference object.

For more info about the StudioPreferences object please see the [StudioPreference](../../StudioPreference/index.md) documentation.

## Examples

You can find examples in the description of the StudioPreference properties.

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC 2019       |         |
| 2020          | v15.2+ ✔|
| 2021          | ✔       |
| 2022          | ✔       |

## See also

* [StudioPreference](../../StudioPreference/index.md)