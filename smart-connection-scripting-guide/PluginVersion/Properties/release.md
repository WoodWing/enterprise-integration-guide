---
layout: chapter
title: release
sortid: 5
permalink: 1258-release
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PluginVersion.release;
```

### Access

_readonly_

### Parameters

**Return value** _string_

The release type of the installed Studio plug-ins.

## Description

The `release` property returns the release type of the installed WoodWing Studio plug-ins as a string. The value is determined at build time and reflects whether the installation is a daily (development) build or an official release build.

| Value       | Description                                                                                |
| ----------- | ------------------------------------------------------------------------------------------ |
| `"daily"`   | The plug-in is a daily (development) build, intended for testing and development purposes. |
| `"release"` | The plug-in is an official release build, intended for production use.                     |

In a version string such as "v21.0.1 DAILY build 34", the release type is `"daily"`. For an official release build without a type prefix in the version string, the release type is `"release"`.

## Examples

**Show a warning when running on a daily build**

```javascript
// Check the release type of the installed Studio plug-in.
var releaseType = app.studioPlugins.version.release;

if (releaseType === "daily") {
  // Warn the user that this is a development build.
  alert(
    "Warning: you are running a daily (development) build of the Studio plug-in. " +
      "Some features may be unstable.",
  );
} else {
  // Official release build: no warning needed.
  alert("Running on Studio plug-in release build.");
}
```

**Conditionally run diagnostics on daily builds**

```javascript
// Only run additional diagnostics when using a daily build.
var version = app.studioPlugins.version;

if (version.release === "daily") {
  // Log the full version details for diagnostic purposes.
  var info =
    "Daily build detected — version: " +
    version.major +
    "." +
    version.minor +
    "." +
    version.patch +
    " build " +
    version.build;
  $.writeln(info);
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
- [patch](./patch.md)
- [build](./build.md)
