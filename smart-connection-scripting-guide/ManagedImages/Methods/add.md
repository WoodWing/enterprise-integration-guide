---
layout: chapter
title: add
sortid: 6600
permalink: 1158-add
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedImages.add();
```

### Parameters

**Return value** _[ManagedImage](../../ManagedImage/index.md)_

The newly created ManagedImage scripting object.

## Description

The `add()` method creates a new [ManagedImage](../../ManagedImage/index.md) scripting object and adds it to the ManagedImages collection. The image is not yet created on Studio Server at this point. Call `create()` on the returned ManagedImage object to save it to Studio Server.

## Examples

**Add a new ManagedImage and create it on Studio Server**

```javascript
// Add a ManagedImage scripting object, set its metadata, then create it on Studio Server.
var image = app.activeDocument.managedImages.add();
image.entMetaData.set("Core_Name", "My Image");
image.entMetaData.set("Core_Publication", "WW News");
image.create(app.selection[0]);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [ManagedImage.create()](../../ManagedImage/Methods/create.md)
