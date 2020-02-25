---
layout: chapter
title: afterCreateLayout
sortid: 115
permalink: 1179-afterCreateLayout
---

## When

After creating a new layout in the Enterprise system. This includes Save As.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

|Key |Description|
|----|-----------|
|Core_ID |The object id of the layout that was created.|

## Arguments out

n/a

## Notes

Changes can be made to the document, these will be saved and sent to the Enterprise system.

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