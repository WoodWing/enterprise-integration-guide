---
layout: chapter
title: getCategory
sortid: 83
permalink: 1208-getCategory
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.getCategory(brandName, categoryName, issueName);
```

### Parameters

**publication** _string_

The name of the Brand.

**category** _string_

The name of the Category..

**issue** _string (Optional)_

The name of the overruled Issue.

**Return value** _[EntSection](../../EntSection/index.md)_

Returns the Category with the provided name. Throws an exception if the Category does not exist.

## Description

The `getCategory()` method returns the Category with the provided name.

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
