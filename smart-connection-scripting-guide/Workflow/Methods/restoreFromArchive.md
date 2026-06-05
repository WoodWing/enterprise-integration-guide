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

Defines the restore location of images. When not defined, the option configured in the Assets plug-in is used. Possible values:

| Value           | Description                                                                    |
| --------------- | ------------------------------------------------------------------------------ |
| Elvis_Copy      | The image is copied in Assets and is linked via a Studio Server shadow object. |
| Elvis_Original  | The image is linked from its original location in Assets.                      |
| Enterprise      | The image is copied to Studio Server.                                          |

**Return value** _[Document](../../Document/index.md)_

The Document object representing the restored document.

## Description

The `restoreFromArchive()` method restores the active archived document from Assets as a new object in Studio Server. Set the desired metadata on the document via [entMetaData](../../Document/Properties/entMetaData.md) before calling `restoreFromArchive()`. Throws an exception in case of an error.

Articles on the document are copied to Studio Server and Article Components receive new IDs. Spreadsheets are also copied to Studio Server.

## Examples

**Restore the archived document using the server's default image restore setting**

```javascript
// Restore the archived document; image restore location is determined by the server.
try {
  var doc = app.activeDocument.entWorkflow.restoreFromArchive();
  alert("Document restored: " + doc.name);
} catch (e) {
  alert("Restore failed: " + e.message);
}
```

**Restore with images copied to a specific path in Assets**

```javascript
// Restore and copy images to a specific path in Assets.
try {
  var doc = app.activeDocument.entWorkflow.restoreFromArchive("/restored/images", "Elvis_Copy");
  alert("Document restored: " + doc.name);
} catch (e) {
  alert("Restore failed: " + e.message);
}
```

**Restore with images copied to Studio Server**

```javascript
// Restore and copy images to Studio Server.
try {
  var doc = app.activeDocument.entWorkflow.restoreFromArchive("", "Enterprise");
  alert("Document restored: " + doc.name);
} catch (e) {
  alert("Restore failed: " + e.message);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
