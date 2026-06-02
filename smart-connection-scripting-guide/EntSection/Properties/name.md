---
layout: chapter
title: name
sortid: 46
permalink: 1125-name
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntSection.name;
```

### Access

_readonly_

### Parameters

**Return value** _string_

The name of the Category.

## Description

The `name` property returns the name of the Category as defined on Studio Server.

## Examples

**Get the name of a Category**

```javascript
// Get the name of a Category on Studio Server.
var section = app.entSession.getCategory("WW News", "News");
var sectionName = section.name;
alert("Category name: " + sectionName);
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
