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

**publication** *string*

The name of the Brand.

**Return value** *Array of [Issue](../../EntIssue/index.md)*

Returns a list of all Issues of the provided Brand.

## Description

The `getIssues()` method returns a list of all Issues of the provided Brand.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC            |         |
| CC 2014       | ✔       |
| CC 2015       | ✔       |
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |
| 2020          | ✔       |