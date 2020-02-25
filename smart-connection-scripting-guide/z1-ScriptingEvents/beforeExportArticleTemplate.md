---
layout: chapter
title: beforeExportArticleTemplate
sortid: 134
permalink: 1198-beforeExportArticleTemplate
---

## When

Before creating the XML representation of an article template on disk.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

n/a

## Arguments out

n/a

## Notes

Changes made to the text will be part of the export, as well as changes made to the layout in InDesign
(Server) that will be part of the template information.

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |

## See also

* [Scripting Events](./index.md)