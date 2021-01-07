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

**publication** *string*

The name of the Brand.

**category** *string*

The name of the Category..

**issue** *string (Optional)*

The name of the overruled Issue.

**Return value** *[EntSection](../../EntSection/index.md)*

Returns the Category with the provided name. Throws an exception if the Category does not exist.

## Description

The `getCategory()` method returns the Category with the provided name. 

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC 2018       | ✔       |
| CC 2019       | ✔       |
| 2020          | ✔       |
| 2021          | ✔       |