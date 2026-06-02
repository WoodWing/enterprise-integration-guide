---
layout: chapter
title: getSection
sortid: 107
permalink: 1271-getSection
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getSection(brandName, sectionName [, issueName]);
```

### Parameters

**brandName** _string_

The name of the Brand.

**sectionName** _string_

The name of the Section.

**issueName** _string (Optional)_

The name of the overruled Issue.

**Return value** _[EntSection](../../EntSection/index.md)_

Returns the Section with the provided name. Throws an exception if the Section does not exist.

## Description

The `getSection()` method returns the Section with the provided name from the provided Brand. It is an alias for [getCategory()](./getCategory.md).

## Examples

**Get a specific Section**

```javascript
// Get the Section "Sport" from the Brand "WW News".
var section = app.entSession.getSection("WW News", "Sport");
alert("Section ID: " + section.id + ", name: " + section.name);
```

**Get a Section scoped to a specific Issue**

```javascript
// Get the Section "Sport" scoped to the Issue "1st Issue".
var section = app.entSession.getSection("WW News", "Sport", "1st Issue");
alert("Section ID: " + section.id);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [getCategory](./getCategory.md)
- [getSections](./getSections.md)
