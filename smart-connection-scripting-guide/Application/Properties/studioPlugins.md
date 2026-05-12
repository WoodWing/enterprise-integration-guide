---
layout: chapter
title: studioPlugins
sortid: 13
permalink: 1248-studioPlugins
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.studioPlugins;
```

### Access

_readonly_

### Parameters

**Return value** _[StudioPlugins](../../StudioPlugins/index.md)_

The StudioPlugins object, giving access to information about the installed WoodWing Studio plug-ins.

## Description

The `studioPlugins` property gives access to information about the installed WoodWing Studio plug-ins by returning a [StudioPlugins](../../StudioPlugins/index.md) object. Use this object to retrieve the version of the installed Studio plug-ins.

## Examples

**Retrieve the full version string of the installed Studio plug-in**

```javascript
// Get the plug-in version information via the StudioPlugins object.
var version = app.studioPlugins.version;

// Compose a version string from the individual version components.
var versionString =
  version.major +
  "." +
  version.minor +
  "." +
  version.patch +
  " build " +
  version.build;
alert("Installed Studio plug-in version: " + versionString);
// Example result: "21.0.1 build 34"
```

## Supported versions

| Adobe Version  | Supported |
| -------------- | --------- |
| 2023           |           |
| 2024           |           |
| 2025 (v20.0.4) | ✔         |
| 2026 (v21.0.1) | ✔         |

## See also

- [StudioPlugins](../../StudioPlugins/index.md)
