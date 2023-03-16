---
layout: chapter
title: editions
sortid: 75
permalink: 1236-editions
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
PageItem.editions;
```

### Access

_read/write_

### Parameters

**Return value** _Array of string_

A string of Edition names.

## Description

The Editions assigned to the page item. When assigning to a text
frame, all linked text frames will get the same set of Editions
assigned.

## Examples

**Example title**

```javascript

```

## Support versions

| Adobe Version | Support |
| ------------- | ------- |
| 2020          | ✔       |
| 2021          | ✔       |
| 2022          | ✔       |
| 2023          | ✔       |
