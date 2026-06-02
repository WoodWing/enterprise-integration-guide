---
layout: chapter
title: id
sortid: 43
permalink: 1119-id
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntPublication.id;
```

### Access

_readonly_

### Parameters

**Return value** _string_

The Studio Server object ID of the Brand.

## Description

The `id` property returns the unique object ID of the Brand as stored on Studio Server.

## Examples

**Get the ID of a Brand**

```javascript
// Get the ID of a Brand on Studio Server.
var publication = app.entSession.getPublication("WW News");
var pubId = publication.id;
alert("Brand ID: " + pubId);
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
