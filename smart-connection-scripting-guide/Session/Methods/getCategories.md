---
layout: chapter
title: getCategories
sortid: 82
permalink: 1207-getCategories
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Session.getCategories(brandName,issueName);
```

### Parameters

**publication** *string*

The name of the Brand.

**issue** *string (Optional)*

The name of the overruled Issue.

**Return value** *Array of [EntSection](../../EntSection/index.md)*

Returns a list of all Categories of the provided Brand and Issue.

## Description

The `getCategories()` method returns a list of all Categories of the provided Brand and Issue.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |
| 2020          | ✔       |