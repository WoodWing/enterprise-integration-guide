---
layout: chapter
title: getCategory
sortid: 83
permalink: 1208-getCategory
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getCategory(brandName, categoryName [, issueName]);
```

### Parameters

**brandName** _string_

The name of the Brand.

**categoryName** _string_

The name of the Category.

**issueName** _string (Optional)_

The name of the overruled Issue.

**Return value** _[EntSection](../../EntSection/index.md)_

Returns the Category with the provided name. Throws an exception if the Category does not exist.

## Description

The `getCategory()` method returns the Category with the provided name.

## Examples

**Get a specific Category**

```javascript
// Get the Category "Sport" from the Brand "WW News".
var category = app.entSession.getCategory("WW News", "Sport");
alert("Category ID: " + category.id + ", name: " + category.name);
```

**Get a Category scoped to a specific Issue**

```javascript
// Get the Category "Sport" scoped to the Issue "1st Issue".
var category = app.entSession.getCategory("WW News", "Sport", "1st Issue");
alert("Category ID: " + category.id);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [getSection](./getSection.md)
- [getCategories](./getCategories.md)
