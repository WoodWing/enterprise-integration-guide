---
layout: chapter
title: beforeImportImage
sortid: 136
permalink: 1199-beforeImportImage
---

## When

Before importing (planned) image type files when synchronizing planned layouts and adverts.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

| Key              | Description                                         |
| ---------------- | --------------------------------------------------- |
| Core_ID          | The object id of the image being imported.          |
| Core_Name        | The name of the image.                              |
| Core_Publication | The Brand the image belongs to.                     |
| Core_Issue       | The Issue the image belongs to.                     |
| Core_Section     | The Section the image belongs to.                   |
| Editions         | The Edition(s) the image belongs to.                |
| Core_Basket      | The Status of the image.                            |
| RouteTo          | The routing of the image.                           |
| Type             | The file type of the image.                         |
| Format           | The file format of the image.                       |
| pageitem         | The id of the frame the image is placed into.       |

## Arguments out

n/a

## Notes

This event is not called when importing image type files from panels in Studio for InDesign and InCopy.

## Examples

**Using beforeImportImage**

```javascript
var msg = "ID: " + app.scriptArgs.get("Core_ID") + "\n";
msg += "Name: " + app.scriptArgs.get("Core_Name") + "\n";
msg += "Brand: " + app.scriptArgs.get("Core_Publication") + "\n";
msg += "Issue: " + app.scriptArgs.get("Core_Issue") + "\n";
msg += "Section: " + app.scriptArgs.get("Core_Section") + "\n";
msg += "Editions: " + app.scriptArgs.get("Editions") + "\n";
msg += "Status: " + app.scriptArgs.get("Core_Basket") + "\n";
msg += "RouteTo: " + app.scriptArgs.get("RouteTo") + "\n";
msg += "File type: " + app.scriptArgs.get("Type") + "\n";
msg += "File format: " + app.scriptArgs.get("Format") + "\n";
msg += "Frame ID: " + app.scriptArgs.get("pageitem") + "\n";
alert(msg);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [Scripting Events](./index.md)
