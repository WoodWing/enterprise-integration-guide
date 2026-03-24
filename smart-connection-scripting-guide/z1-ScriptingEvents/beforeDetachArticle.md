---
layout: chapter
title: beforeDetachArticle
sortid: 133
permalink: 1196-beforeDetachArticle
---

## When

Before detaching an article from a layout. A template of placed components of the article was generated
for scripter to use before detaching the article component.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

| Key                 | Description                                         |
| ------------------- | --------------------------------------------------- |
| Core_ID             | The object ID of the article that will be detached. |
| templateGeoFilePath | The template file path.                             |

## Arguments out

n/a

## Notes

A template with all placed components of the article will be generated in the file path: templateGeoFilePath, and will be deleted after the event.

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [Scripting Events](./index.md)
