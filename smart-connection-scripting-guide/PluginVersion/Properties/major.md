---
layout: chapter
title: major
sortid: 1
permalink: 1254-major
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PluginVersion.major;
```

### Access

_readonly_

### Parameters

**Return value** _number_

The major version number of the installed Studio plug-ins.

## Description

The `major` property returns the major version number component of the installed WoodWing Studio plug-ins version. In a version string such as "v21.0.1 DAILY build 34", the major version number is `21`.

## Examples

**Check if the installed plug-in meets a minimum major version requirement**

```javascript
// Get the major version number of the installed Studio plug-in.
var major = app.studioPlugins.version.major;

// Verify the plug-in meets the minimum required version.
if (major < 21) {
  alert(
    "This script requires Studio plug-in version 21 or higher. Installed version: " +
      major,
  );
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          |           |
| 2024          |           |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [PluginVersion](../../PluginVersion/index.md)
- [minor](./minor.md)
- [patch](./patch.md)
- [build](./build.md)
- [release](./release.md)
