---
layout: chapter
title: name
sortid: 44
permalink: 1121-name
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntPublication.name;
```

### Access

_readonly_

### Parameters

**Return value** _string_

The name of the Brand.

## Description

The `name` property returns the name of the Brand as defined on Studio Server.

## Examples

**Get the name of a Brand**

```javascript
// Get the name of a Brand on Studio Server.
var publication = app.entSession.getPublication("WW News");
var pubName = publication.name;
alert("Brand name: " + pubName);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [getPublication](../../Session/Methods/getPublication.md)
- [getPublications](../../Session/Methods/getPublications.md)
