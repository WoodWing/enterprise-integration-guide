---
layout: chapter
title: afterExportArticle
sortid: 118
permalink: 1182-afterExportArticle
---

## When

After creating the XML representation of an article on disk.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

| Key     | Description                                     |
| ------- | ----------------------------------------------- |
| Core_ID | The object id of the article that was exported. |

## Arguments out

n/a

## Notes

`Core_ID` is not available in all export code paths. Use `app.scriptArgs.isDefined("Core_ID")` before accessing it.

## Examples

**Using afterExportArticle**

```javascript
var msg = "Article exported";
if (app.scriptArgs.isDefined("Core_ID"))
  msg += " (ID: " + app.scriptArgs.get("Core_ID") + ")";
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
