---
layout: chapter
title: beforeDetachArticle
sortid: 62
permalink: 1196-beforeDetachArticle
---

## When 
Before detaching an article from a layout. A template of placed components of the article was generated
for scripter to use before detaching the article component.

## Where 
InDesign, InDesign Server.

## Arguments in 
|Key |Description|
|----|-----------|
|Core_ID |The object ID of the article that will be detached.|
|templateGeoFilePath |The template file path.|

## Arguments out 
n/a

## Notes 
A template with all placed components of the article will be generated in the file path: templateGeoFilePath, and will be deleted after the event.

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