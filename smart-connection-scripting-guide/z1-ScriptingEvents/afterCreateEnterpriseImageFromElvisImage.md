---
layout: chapter
title: afterCreateEnterpriseImageFromElvisImage
sortid: 113
permalink: 1177-afterCreateEnterpriseImageFromElvisImage
---

## When

After a Studio Server Image was created from an Assets Image (and added to a Dossier)

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

| Key      | Description                                 |
| -------- | ------------------------------------------- |
| pageitem | The id of the frame that contains the image. |
| Core_ID  | The object id of the created image.         |

## Arguments out

n/a

## Notes

## Examples

**Using afterCreateEnterpriseImageFromElvisImage**

```javascript
var msg = "Created image ID: " + app.scriptArgs.get("Core_ID") + "\n";
msg += "Frame ID: " + app.scriptArgs.get("pageitem");
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
