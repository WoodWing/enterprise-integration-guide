---
layout: chapter
title: restoreFromArchive
sortid: 103
permalink: 1176-restoreFromArchive
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.restoreFromArchive([pathInElvis] [, imageRestoreLocation]);
```

### Parameters

**pathInElvis** _String (Optional)_

The path in Assets where the images should be copied to. Might be empty. In that case the images are not restored and will be unlinked.

Only used in combination with the “Elvis_Copy” image restore location (defined in the script or in the Elvis Enterprise Server plug-in). For the other image restore locations this parameter can be empty.

**imageRestoreLocation** _String (Optional)_

Defines the restore location of images. When not defined the option as defined in the Elvis Enterprise Server plug-in is used. Possible values:

| Value      | Description                                                                   |
| ---------- | ----------------------------------------------------------------------------- |
| Elvis_Copy | The image is copied in Assets and is linked via a Studio Server shadow object |
| Enterprise | The image is copied to Studio Server                                          |

**Return value** _Document_

The restored Document object.

## Description

The `restoreFromArchive()` method restores the opened archived document from Assets as a new object in the Studio Server system. Throws an exception in case of an error. Change the metadata before calling `restoreFromArchive()`.

Articles on the document will be copied to Studio Server and the Article Components will get new IDs. Spreadsheets are copied to Studio Server.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
