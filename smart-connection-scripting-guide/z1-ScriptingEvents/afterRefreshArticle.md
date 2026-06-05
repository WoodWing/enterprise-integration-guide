---
layout: chapter
title: afterRefreshArticle
sortid: 125
permalink: 1188-afterRefreshArticle
---

## When

After refreshing the XML representation of an article from disk.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

| Key     | Description                                      |
| ------- | ------------------------------------------------ |
| Core_ID | The object id of the article that was refreshed. |

## Arguments out

n/a

## Notes

## Examples

**Using afterRefreshArticle**

```javascript
var msg = "Refreshed article ID: " + app.scriptArgs.get("Core_ID");
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
