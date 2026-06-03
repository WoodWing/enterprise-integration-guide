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

`true` if Smart Caching is enabled, `false` if it is disabled.

## Description

The `enableSmartCaching` property defines if Smart Caching (automatically downloading a file onto a user's system when the file is routed to that user) should be enabled.

The default value is `true`.

## Examples

**Read the current preference**

```javascript
// Read whether Smart Caching is currently enabled.
var pref = app.studioPreferences.enableSmartCaching;
alert("Smart Caching enabled: " + pref);
```

**Enable Smart Caching**

```javascript
// Enable Smart Caching so files are automatically downloaded when routed to the user.
app.studioPreferences.enableSmartCaching = true;
```

**Disable Smart Caching**

```javascript
// Disable Smart Caching so files are not automatically downloaded when routed.
app.studioPreferences.enableSmartCaching = false;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
