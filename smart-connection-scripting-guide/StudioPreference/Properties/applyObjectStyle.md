---
layout: chapter
title: applyObjectStyle
sortid: 68
permalink: 1162-applyObjectStyle
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
StudioPreference.applyObjectStyle;
```

### Access

_read/write_

### Parameters

**Return value** _ApplyObjectStyleOptions_

An ApplyObjectStyleOptions enum value (see below).

## Description

The `applyObjectStyle` property defines if and when an object style should be automatically applied to an article.

Use one of the following options:

| Value                                                 | Description                                                                             |
| ----------------------------------------------------- | --------------------------------------------------------------------------------------- |
| ApplyObjectStyleOptions.APPLY_DURING_CREATE_AND_PLACE | Only apply the object style when creating or placing the article, not when updating it. |
| ApplyObjectStyleOptions.REAPPLY_WHEN_UPDATING         | Always apply the object style.                                                          |
| ApplyObjectStyleOptions.DO_NOT_APPLY                  | Never apply the object style.                                                           |

The default value is ApplyObjectStyleOptions.APPLY_DURING_CREATE_AND_PLACE.

## Examples

**Read the current preference**

```javascript
// Read the current applyObjectStyle preference.
var pref = app.studioPreferences.applyObjectStyle;
alert("Apply object style: " + pref);
```

**Apply the object style only during create and place**

```javascript
// Apply the object style only when creating or placing — not on updates.
app.studioPreferences.applyObjectStyle =
  ApplyObjectStyleOptions.APPLY_DURING_CREATE_AND_PLACE;
```

**Always reapply the object style**

```javascript
// Always reapply the object style, including when updating an article.
app.studioPreferences.applyObjectStyle =
  ApplyObjectStyleOptions.REAPPLY_WHEN_UPDATING;
```

**Never apply the object style**

```javascript
// Never apply an object style automatically.
app.studioPreferences.applyObjectStyle =
  ApplyObjectStyleOptions.DO_NOT_APPLY;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
