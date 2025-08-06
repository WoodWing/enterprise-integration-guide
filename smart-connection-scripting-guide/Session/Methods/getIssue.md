---
layout: chapter
title: getIssue
sortid: 84
permalink: 1209-getIssue
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.getIssue(brandName, issueName);
```

### Parameters

**brandName** _string_

The name of the Brand.

**issueName** _string_

The name of the Issue.

**Return value** _[EntIssue](../../EntIssue/index.md)_

The EntIssue object on the Studio Server.

## Description

The `getIssue()` method returns an EntIssue object from the Studio Server for the provided Brand name and Issue name. If the object does not exist it will throw an exception.

## Examples

**Example title**

```javascript
var entIssue = app.entSession.getIssue("WW News", "1st Issue");
// Return value: { id: "1", name: "1st Issue" }
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
