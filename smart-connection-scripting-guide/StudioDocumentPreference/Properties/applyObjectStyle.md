---
layout: chapter
title: applyObjectStyle
sortid: 69
permalink: 1305-applyObjectStyle
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

The `applyObjectStyle` property defines if and when an object style should be automatically applied to an article in this specific document. It is the document-level counterpart of [studioPreferences.applyObjectStyle](../../StudioPreference/Properties/applyObjectStyle.md): both control the same behavior and share the same enum values, but their settings are stored and read independently. Changing one does not affect the other.

Use one of the following options:

| Value                                                 | Description                                                                             |
| ----------------------------------------------------- | --------------------------------------------------------------------------------------- |
| ApplyObjectStyleOptions.APPLY_DURING_CREATE_AND_PLACE | Only apply the object style when creating or placing the article, not when updating it. |
| ApplyObjectStyleOptions.REAPPLY_WHEN_UPDATING         | Always apply the object style.                                                          |
| ApplyObjectStyleOptions.DO_NOT_APPLY                  | Never apply the object style.                                                           |

The default value is `ApplyObjectStyleOptions.APPLY_DURING_CREATE_AND_PLACE`.

## Examples

**Read the current setting for the active document**

```javascript
// Read the current applyObjectStyle preference for the active document.
var pref = app.activeDocument.studioDocumentPreferences.applyObjectStyle;
alert("Apply object style: " + pref);
```

**Set to apply only during create and place**

```javascript
// Apply the object style only when creating or placing — not on updates.
app.activeDocument.studioDocumentPreferences.applyObjectStyle =
  ApplyObjectStyleOptions.APPLY_DURING_CREATE_AND_PLACE;
```

**Set to always reapply when updating**

```javascript
// Always reapply the object style, including when updating an article.
app.activeDocument.studioDocumentPreferences.applyObjectStyle =
  ApplyObjectStyleOptions.REAPPLY_WHEN_UPDATING;
```

**Set to never apply**

```javascript
// Never apply an object style automatically for this document.
app.activeDocument.studioDocumentPreferences.applyObjectStyle =
  ApplyObjectStyleOptions.DO_NOT_APPLY;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [studioDocumentPreferences](../../Document/Properties/studioDocumentPreferences.md)
- [studioPreferences.applyObjectStyle](../../StudioPreference/Properties/applyObjectStyle.md)
