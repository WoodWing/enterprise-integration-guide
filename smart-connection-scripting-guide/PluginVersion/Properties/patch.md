---
layout: chapter
title: patch
sortid: 3
permalink: 1256-patch
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PluginVersion.patch;
```

### Access

_readonly_

### Parameters

**Return value** _number_

The patch version number of the installed Studio plug-ins.

## Description

The `patch` property returns the patch version number component of the installed WoodWing Studio plug-ins version. In a version string such as "v21.0.1 DAILY build 34", the patch version number is `1`.

## Examples

**Verify whether a required patch version is installed**

```javascript
// Check whether a minimum patch version is installed.
var version = app.studioPlugins.version;

// In a version string such as "v21.0.1 DAILY build 34", the patch number is 1.
if (version.major === 21 && version.minor === 0 && version.patch < 1) {
  alert(
    "Update required: plug-in v21.0.1 or higher is needed. " +
      "Installed patch: " +
      version.patch,
  );
} else {
  alert(
    "Studio plug-in v21.0.1 or higher is installed (patch: " +
      version.patch +
      ").",
  );
}
```

## Supported versions

| Adobe Version  | Supported |
| -------------- | --------- |
| 2023           |           |
| 2024           |           |
| 2025 (v20.0.4) | ✔         |
| 2026 (v21.0.1) | ✔         |

## See also

- [PluginVersion](../../PluginVersion/index.md)
- [major](./major.md)
- [minor](./minor.md)
- [build](./build.md)
- [release](./release.md)
