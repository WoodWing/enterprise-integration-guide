---
layout: chapter
title: getBrand
sortid: 102
permalink: 1266-getBrand
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getBrand(brandName);
```

### Parameters

**brandName** _string_

The name of the Brand.

**Return value** _[EntPublication](../../EntPublication/index.md)_

Returns the Brand with the provided name. Throws an exception if the Brand does not exist.

## Description

The `getBrand()` method returns the Brand with the provided name. It is an alias for [getPublication()](./getPublication.md).

## Examples

**Get a specific Brand**

```javascript
// Get the Brand named "WW News".
var brand = app.entSession.getBrand("WW News");
alert("Brand ID: " + brand.id + ", name: " + brand.name);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [getPublication](./getPublication.md)
- [getBrands](./getBrands.md)
