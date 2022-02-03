---
layout: chapter
title: getPublication
sortid: 86
permalink: 1211-getPublication
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Session.getPublication(brandName);
```

### Parameters

**publication** *string*

The name of the Brand.

**Return value** *[Publication](../../EntPublication/index.md)*

Returns the Brand with the provided name. Throws an exception if the Brand does not exist.

## Description

The `getPublication()` method returns the Brand with the provided name.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC 2019       | ✔       |
| 2020          | ✔       |
| 2021          | ✔       |
| 2022          | ✔         |
