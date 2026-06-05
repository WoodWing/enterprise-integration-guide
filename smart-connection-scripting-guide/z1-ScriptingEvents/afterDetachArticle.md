---
layout: chapter
title: afterDetachArticle
sortid: 117
permalink: 1181-afterDetachArticle
---

## When

After detaching an article from a layout.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

| Key     | Description                                     |
| ------- | ----------------------------------------------- |
| Core_ID | The object id of the article that was detached. |

## Arguments out

n/a

## Notes

This event is only broadcasted when using the Detach Article action, not when detaching by deleting the
article from the layout.

## Examples

**Using afterDetachArticle**

```javascript
var msg = "Detached article ID: " + app.scriptArgs.get("Core_ID");
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
