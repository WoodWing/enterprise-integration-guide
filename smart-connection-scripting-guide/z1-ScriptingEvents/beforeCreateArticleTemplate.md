---
layout: chapter
title: beforeCreateArticleTemplate
sortid: 130
permalink: 1193-beforeCreateArticleTemplate
---

## When

Before sending a new article template to the Enterprise or Studio Server system.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

n/a

## Arguments out

n/a

## Notes

Don’t change the text of the article template at this stage. Changes will not be sent to the server. Use beforeExportArticle instead.

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |
| 2021          | ✔         |

## See also

* [Scripting Events](./index.md)