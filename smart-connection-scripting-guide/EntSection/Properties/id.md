---
layout: chapter
title: id
sortid: 45
permalink: 1123-id
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntSection.id;
```

### Access

_readonly_

### Parameters

**Return value** _string_

The Studio Server object ID of the Category.

## Description

The `id` property returns the unique object ID of the Category as stored on Studio Server.

## Examples

**Get the ID of a Category**

```javascript
// Get the ID of a Category on Studio Server.
var section = app.entSession.getCategory("WW News", "News");
var sectionId = section.id;
alert("Category ID: " + sectionId);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [getCategory](../../Session/Methods/getCategory.md)
