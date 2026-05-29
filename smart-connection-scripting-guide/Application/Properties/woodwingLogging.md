---
layout: chapter
title: woodwingLogging
sortid: 11
permalink: 1088-woodwingLogging
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.woodwingLogging;
```

### Access

_read/write_

### Parameters

**Return value** _boolean_

`true` if WoodWing logging is currently enabled, `false` if it is disabled.

## Description

The `woodwingLogging` property enables or disables WoodWing plug-in logging. When enabled, the plug-in writes verbose trace and debug output to a log file on disk. This is useful for troubleshooting issues with the Studio plug-in.

The log file is written to the WoodWing folder in the local application data directory of the current user:

- **macOS**: `~/Library/Application Support/WoodWing.noindex/`
- **Windows**: `C:\Users\<username>\AppData\Local\WoodWing\`

The log file name depends on the host application:

| Host application  | Log file name                        |
| ----------------- | ------------------------------------ |
| InDesign          | `Log_InDesign.txt`                   |
| InCopy            | `Log_InCopy.txt`                     |
| InDesign Server   | `Log_InDesignServer[_<port>].txt`    |

## Examples

**Turn on WoodWing logging**

```javascript
// Enable WoodWing logging.
app.woodwingLogging = true;
```

**Turn off WoodWing logging**

```javascript
// Disable WoodWing logging.
app.woodwingLogging = false;
```

**Read the current logging state**

```javascript
// Check whether WoodWing logging is currently enabled.
var loggingEnabled = app.woodwingLogging;
alert("WoodWing logging is " + (loggingEnabled ? "enabled" : "disabled"));
```

**Temporarily enable logging around an operation**

```javascript
// Enable logging, run the operation, then restore the previous state.
var previousState = app.woodwingLogging;
app.woodwingLogging = true;

try {
    app.openObject("6315");
} finally {
    app.woodwingLogging = previousState;
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
