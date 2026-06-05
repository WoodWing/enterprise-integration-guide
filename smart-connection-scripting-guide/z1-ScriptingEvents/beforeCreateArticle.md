---
layout: chapter
title: beforeCreateArticle
sortid: 129
permalink: 1192-beforeCreateArticle
---

## When

Before sending a new article to the Studio Server system.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

n/a

## Arguments out

n/a

## Notes

Don’t change the text of the article at this stage. Changes will not be sent to the server. Use beforeExportArticle instead.

## Examples

**Using beforeCreateArticle**

```javascript
// beforeCreateArticle.jsx - runs before sending a new article to Studio Server
alert("About to create a new article.");
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
