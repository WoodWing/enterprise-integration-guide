---
layout: chapter
title: studioDocumentPreferences
sortid: 12
permalink: 1087-studioDocumentPreferences
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Document.studioDocumentPreferences;
```

### Access

_readonly_

### Parameters

**Return value** _[StudioDocumentPreference](../../StudioDocumentPreference/index.md)_

The WoodWing Studio Document preference settings object.

## Description

The `studioDocumentPreferences` property gives access to the WoodWing Studio Document preference settings by returning a [StudioDocumentPreference](../../StudioDocumentPreference/index.md) object. Use this object to read or change document-level preferences such as the object style application behavior.

## Examples

**Read the current document-level object style preference**

```javascript
// Get the applyObjectStyle preference for the active document.
var pref = app.activeDocument.studioDocumentPreferences.applyObjectStyle;
alert("Apply object style: " + pref);
```

**Set the document-level object style preference**

```javascript
// Always reapply the object style when updating an article.
app.activeDocument.studioDocumentPreferences.applyObjectStyle =
  ApplyObjectStyleOptions.REAPPLY_WHEN_UPDATING;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [StudioDocumentPreference](../../StudioDocumentPreference/index.md)
