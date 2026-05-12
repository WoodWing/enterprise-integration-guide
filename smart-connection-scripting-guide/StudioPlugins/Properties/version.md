---
layout: chapter
title: version
sortid: 1
permalink: 1251-version
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
StudioPlugins.version;
```

### Access

_readonly_

### Parameters

**Return value** _[PluginVersion](../../PluginVersion/index.md)_

The PluginVersion object, exposing the individual version number components of the installed Studio plug-ins.

## Description

The `version` property returns a [PluginVersion](../../PluginVersion/index.md) object that exposes the individual components of the installed WoodWing Studio plug-ins version: the major, minor and patch numbers, the build number, and the release type.

## Examples

**Check all version components of the installed Studio plug-in**

```javascript
// Get the version object from the StudioPlugins object.
var version = app.studioPlugins.version;

// Read each version component individually.
var major = version.major; // e.g. 21
var minor = version.minor; // e.g. 0
var patch = version.patch; // e.g. 1
var build = version.build; // e.g. 34
var release = version.release; // e.g. "release" or "daily"

alert(
  "Version: " +
    major +
    "." +
    minor +
    "." +
    patch +
    " build " +
    build +
    " (" +
    release +
    ")",
);
// Example result: "Version: 21.0.1 build 34 (release)"
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
