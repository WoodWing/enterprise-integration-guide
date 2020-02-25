---
layout: chapter
title: beforeCreateArticleTemplate
sortid: 129
permalink: 1193-beforeCreateArticleTemplate
---

## When

Before sending a new article template to the Enterprise system.

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
| CC            | ✔         |
| CC 2014       | ✔         |
| CC 2015       | ✔         |
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |

## See also

* [Scripting Events](./index.md)