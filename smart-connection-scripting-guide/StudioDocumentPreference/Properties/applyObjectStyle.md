---
layout: chapter
title: applyObjectStyle
sortid: 68
permalink: 1162-applyObjectStyle
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
StudioDocumentPreference.applyObjectStyle;
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

**Set the "Apply Object Style" preference to "Do Not Apply" for the active Document**

```javascript
app.activeDocument.studioDocumentPreferences.applyObjectStyle =
  ApplyObjectStyleOptions.DO_NOT_APPLY;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |

