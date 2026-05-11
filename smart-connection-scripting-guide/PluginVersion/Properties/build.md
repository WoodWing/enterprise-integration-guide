---
layout: chapter
title: build
sortid: 4
permalink: 1257-build
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PluginVersion.build;
```

### Access

_readonly_

### Parameters

**Return value** _number_

The build number of the installed Studio plug-ins.

## Description

The `build` property returns the build number of the installed WoodWing Studio plug-ins. In a version string such as "v21.0.1 DAILY build 34", the build number is `34`.

The build number increments with every build produced from source, making it useful for identifying the exact binary installed, independently of the semantic version number.

## Examples

**Log the complete version information of the installed plug-in**

```javascript
// Retrieve all version components.
var version = app.studioPlugins.version;

// Compose the full version string as it appears in the About box.
var semver = version.major + "." + version.minor + "." + version.patch;
var buildNumber = version.build;
var releaseType = version.release;

alert(
  "Studio plug-in: " +
    semver +
    " build " +
    buildNumber +
    " (" +
    releaseType +
    ")",
);
// Example result: "Studio plug-in: 21.0.1 build 34 (daily)"
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
- [patch](./patch.md)
- [release](./release.md)
