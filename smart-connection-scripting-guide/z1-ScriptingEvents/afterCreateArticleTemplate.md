---
layout: chapter
title: afterCreateArticleTemplate
sortid: 111
permalink: 1175-afterCreateArticleTemplate
---

## When

After sending a new article template to the Studio Server system.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

| Key     | Description                                             |
| ------- | ------------------------------------------------------- |
| Core_ID | The object id of the article template that was created. |

## Arguments out

n/a

## Notes

## Examples

**Using afterCreateArticleTemplate**

```javascript
var msg = "Created article template ID: " + app.scriptArgs.get("Core_ID");
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
