---
layout: chapter
title: afterCreateLayout
sortid: 115
permalink: 1179-afterCreateLayout
---

## When

After creating a new layout in the Studio Server system. This includes Save As.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

| Key     | Description                                   |
| ------- | --------------------------------------------- |
| Core_ID | The object id of the layout that was created. |

## Arguments out

n/a

## Notes

Changes can be made to the document, these will be saved and sent to the Studio Server system.

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [Scripting Events](./index.md)
