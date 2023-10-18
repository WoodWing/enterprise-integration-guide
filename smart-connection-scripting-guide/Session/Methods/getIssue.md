---
layout: chapter
title: getIssue
sortid: 84
permalink: 1209-getIssue
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.getIssue(issueName, brandName);
```

### Parameters

**brandName** _string_

The name of the Brand.

**issueName** _string_

The name of the Issue.

**Return value** _[Issue](../../EntIssue/index.md)_

Returns the Issue with the provided name from the provided Brand. Throws an exception if the Issue does not exist.

## Description

The `getIssue()` method returns the Issue with the provided name from the provided Brand.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2020          | ✔         |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
