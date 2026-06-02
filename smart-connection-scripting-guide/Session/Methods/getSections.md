---
layout: chapter
title: getSections
sortid: 106
permalink: 1270-getSections
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getSections(brandName [, issueName]);
```

### Parameters

**brandName** _string_

The name of the Brand.

**issueName** _string (Optional)_

The name of the overruled Issue.

**Return value** _Array of [EntSection](../../EntSection/index.md)_

Returns a list of all Sections of the provided Brand.

## Description

The `getSections()` method returns a list of all Sections of the provided Brand as defined on Studio Server. It is an alias for [getCategories()](./getCategories.md).

## Examples

**Get all Sections of a Brand**

```javascript
// Get all Sections of the Brand "WW News".
var sections = app.entSession.getSections("WW News");
for (var i = 0; i < sections.length; i++) {
    alert("Section: " + sections[i].name + " (ID: " + sections[i].id + ")");
}
```

**Get Sections for a specific Issue**

```javascript
// Get the Sections available for the Issue "1st Issue" of the Brand "WW News".
var sections = app.entSession.getSections("WW News", "1st Issue");
for (var i = 0; i < sections.length; i++) {
    alert("Section: " + sections[i].name);
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

- [getCategories](./getCategories.md)
- [getSection](./getSection.md)
