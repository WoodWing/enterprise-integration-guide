---
layout: chapter
title: getCategories
sortid: 82
permalink: 1207-getCategories
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.getCategories(brandName, issueName);
```

### Parameters

**publication** _string_

The name of the Brand.

**issue** _string (Optional)_

The name of the overruled Issue.

**Return value** _Array of [EntSection](../../EntSection/index.md)_

Returns a list of all Categories of the provided Brand and Issue.

## Description

The `getCategories()` method returns a list of all Categories of the provided Brand and Issue.

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
