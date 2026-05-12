---
layout: chapter
title: minor
sortid: 2
permalink: 1255-minor
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PluginVersion.minor;
```

### Access

_readonly_

### Parameters

**Return value** _number_

The minor version number of the installed Studio plug-ins.

## Description

The `minor` property returns the minor version number component of the installed WoodWing Studio plug-ins version. In a version string such as "v21.0.1 DAILY build 34", the minor version number is `0`.

## Examples

**Retrieve the semantic version string of the installed plug-in**

```javascript
// Combine major, minor and patch to form the semantic version string.
var version = app.studioPlugins.version;
var semver = version.major + "." + version.minor + "." + version.patch;
// For plug-in version "v21.0.1 DAILY build 34", semver is "21.0.1".
alert("Installed Studio plug-in: " + semver);
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
- [patch](./patch.md)
- [build](./build.md)
- [release](./release.md)
