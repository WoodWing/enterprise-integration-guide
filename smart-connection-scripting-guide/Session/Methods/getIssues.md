---
layout: chapter
title: getIssues
sortid: 85
permalink: 1210-getIssues
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.getIssues(brandName);
```

### Parameters

**publication** _string_

The name of the Brand.

**Return value** _Array of [Issue](../../EntIssue/index.md)_

Returns a list of all Issues of the provided Brand.

## Description

The `getIssues()` method returns a list of all Issues of the provided Brand.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2020          | ✔         |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
