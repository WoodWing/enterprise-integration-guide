---
layout: chapter
title: getCategories
sortid: 82
permalink: 1207-getCategories
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getCategories(brandName [, issueName]);
```

### Parameters

**brandName** _string_

The name of the Brand.

**issueName** _string (Optional)_

The name of the overruled Issue.

**Return value** _Array of [EntSection](../../EntSection/index.md)_

Returns a list of all Categories of the provided Brand.

## Description

The `getCategories()` method returns a list of all Categories of the provided Brand.

## Examples

**Get all Categories of a Brand**

```javascript
// Get all Categories of the Brand "WW News".
var categories = app.entSession.getCategories("WW News");
for (var i = 0; i < categories.length; i++) {
    alert("Category: " + categories[i].name + " (ID: " + categories[i].id + ")");
}
```

**Get Categories for a specific Issue**

```javascript
// Get the Categories available for the Issue "1st Issue" of the Brand "WW News".
var categories = app.entSession.getCategories("WW News", "1st Issue");
for (var i = 0; i < categories.length; i++) {
    alert("Category: " + categories[i].name);
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

- [getSections](./getSections.md)
- [getCategory](./getCategory.md)
