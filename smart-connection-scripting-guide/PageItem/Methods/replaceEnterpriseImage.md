---
layout: chapter
title: replaceEnterpriseImage
sortid: 71
permalink: 1233-replaceEnterpriseImage
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.replaceEnterpriseImage(id [, useSmartCheckIn]);
```

### Parameters

**id** _string_

The object ID on Studio Server of the image whose file will be replaced by the file of this page item's image.

**useSmartCheckIn** _boolean (Optional)_

When `true`, only changed files are checked in (smart check-in). When `false`, the file is always checked in regardless of whether it changed. Default is `true`.

Should not be used in combination with the similar option of `ManagedImage.checkIn()`.

**Return value**

The `replaceEnterpriseImage()` method does not return a value.

## Description

The `replaceEnterpriseImage()` method replaces the Studio Server file of the object with the given `id` with the file of this page item's placed image. This is used to update an image on Studio Server with a locally modified version.

## Examples

**Replace the Studio Server file with the file of the current image**

```javascript
// Replace the Studio Server file for the given object ID with this page item's image.
app.selection[0].replaceEnterpriseImage("6315");
```

**Force a full check-in, bypassing smart check-in**

```javascript
// Replace and always upload the file, even if it has not changed.
app.selection[0].replaceEnterpriseImage("6315", false);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [ManagedImage.checkIn()](../Methods/../../ManagedImage/Methods/checkIn.md)
