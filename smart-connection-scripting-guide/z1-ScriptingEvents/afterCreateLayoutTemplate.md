---
layout: chapter
title: afterCreateLayoutTemplate
sortid: 116
permalink: 1180-afterCreateLayoutTemplate
---

## When

After creating a new layout template in the Enterprise or Studio Server system. This includes Save As.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

|Key |Description|
|----|-----------|
|Core_ID| The object id of the layout template that was created.|

## Arguments out

n/a

## Notes

Changes can be made to the document, these will be saved and sent to the Enterprise or Studio Server system.

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |

## See also

* [Scripting Events](./index.md)