---
layout: chapter
title: beforeCreateArticle
sortid: 129
permalink: 1192-beforeCreateArticle
---

## When

Before sending a new article to the Enterprise or Studio Server system.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

n/a

## Arguments out

n/a

## Notes

Don’t change the text of the article at this stage. Changes will not be sent to the server. Use beforeExportArticle instead.

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |
| 2021          | ✔         |

## See also

* [Scripting Events](./index.md)