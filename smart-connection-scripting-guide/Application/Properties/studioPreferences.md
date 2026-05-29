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

_readonly_

### Parameters

**Return value** _[StudioPreference](../../StudioPreference/index.md)_

The WoodWing Studio preference settings object.

## Description

The `studioPreferences` property gives access to the WoodWing Studio preference settings by returning a [StudioPreference](../../StudioPreference/index.md) object. Use this object to read or change preferences such as routing message alerts, panel font sizes, smart caching, object style application, and placed image handling.

## Examples

**Read a preference value**

```javascript
// Get the current routing message alert preference.
var pref = app.studioPreferences.showRoutingMessageAlert;
alert("Routing message alert: " + pref);
```

**Set a preference value**

```javascript
// Show a routing message alert when an object is sent to the current user.
app.studioPreferences.showRoutingMessageAlert =
  ShowRoutingMessageOptions.SHOW_SENT_TO_ME;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [StudioPreference](../../StudioPreference/index.md)
