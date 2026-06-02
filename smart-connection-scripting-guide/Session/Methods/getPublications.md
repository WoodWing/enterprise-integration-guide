---
layout: chapter
title: getPublications
sortid: 87
permalink: 1212-getPublications
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getPublications();
```

### Parameters

**Return value** _Array of [EntPublication](../../EntPublication/index.md)_

The returned array contains a list of all Brands on the current server.

## Description

The `getPublications()` method returns a list of all Brands on the current server.

## Examples

**Get all Brands on the server**

```javascript
// Get all Brands on the server.
var brands = app.entSession.getPublications();
for (var i = 0; i < brands.length; i++) {
    alert("Brand: " + brands[i].name + " (ID: " + brands[i].id + ")");
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [getBrands](./getBrands.md)
