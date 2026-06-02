---
layout: chapter
title: getIssues
sortid: 85
permalink: 1210-getIssues
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getIssues(brandName);
```

### Parameters

**brandName** _string_

The name of the Brand.

**Return value** _Array of [EntIssue](../../EntIssue/index.md)_

Returns a list of all Issues of the provided Brand.

## Description

The `getIssues()` method returns a list of all Issues of the provided Brand.

## Examples

**Get all Issues of a Brand**

```javascript
// Get all Issues of the Brand "WW News".
var issues = app.entSession.getIssues("WW News");
for (var i = 0; i < issues.length; i++) {
    alert("Issue: " + issues[i].name + " (ID: " + issues[i].id + ")");
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
