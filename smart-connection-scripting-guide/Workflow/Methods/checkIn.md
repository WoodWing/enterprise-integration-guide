---
layout: chapter
title: checkIn
sortid: 101
permalink: 1173-checkIn
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.checkIn();
```

### Parameters

**Return value**

The `checkIn()` method does not return anything.

## Description

The `checkIn()` method checks the document in to the Studio or Enterprise Server system.

Use the “Type” key in the EntMetaData to indicate what kind of object should be checked in. Possible values are: “Layout”, “LayoutTemplate”, “LayoutModule” or “LayoutModuleTemplate”.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |

