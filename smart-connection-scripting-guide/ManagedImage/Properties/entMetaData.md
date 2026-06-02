---
layout: chapter
title: entMetaData
sortid: 66
permalink: 1405-entMetaData
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedImage.entMetaData;
```

### Access

_readonly_

### Parameters

**Return value** _[EntMetaData](../../EntMetaData/index.md)_

The Studio Server metadata object associated with the ManagedImage.

## Description

The `entMetaData` property returns an [EntMetaData](../../EntMetaData/index.md) object that provides access to the Studio Server metadata associated with the ManagedImage. Use this object to read metadata values such as the image name, brand, and status.

## Examples

**Read the name of the first managed image**

```javascript
// Get the metadata of the first managed image in the active document.
var images = app.activeDocument.managedImages;
if (images.count() > 0) {
    var image = images[0];
    var name = image.entMetaData.get("Core_Name");
    alert("Image name: " + name);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [EntMetaData](../../EntMetaData/index.md)
