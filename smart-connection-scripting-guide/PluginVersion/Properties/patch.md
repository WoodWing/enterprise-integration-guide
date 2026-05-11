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

**Retrieve the semantic version string of the installed plug-in**

```javascript
// Combine major, minor and patch to form the semantic version string.
var version = app.studioPlugins.version;
var semver = version.major + "." + version.minor + "." + version.patch;
// For plug-in version "v21.0.1 DAILY build 34", semver is "21.0.1".
alert("Installed Studio plug-in: " + semver);
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
- [major](./major.md)
- [minor](./minor.md)
- [build](./build.md)
- [release](./release.md)
