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

|Key |Description|
|----|-----------|
|Core_ID |The object id of the article template that was created.|

## Arguments out

n/a

## Notes

This event is only broadcasted when using the Detach Article action, not when detaching by deleting the
article from the layout.

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC            | ✔         |
| CC 2014       | ✔         |
| CC 2015       | ✔         |
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |

## See also

* [Scripting Events](../../ScriptingEvents/index.md)