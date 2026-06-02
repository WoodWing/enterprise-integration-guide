---
layout: chapter
title: getCurrentIssue
sortid: 103
permalink: 1267-getCurrentIssue
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getCurrentIssue(brandName);
```

### Parameters

**brandName** _string_

The name of the Brand.

**Return value** _[EntIssue](../../EntIssue/index.md)_

Returns the current Issue of the provided Brand. Throws an exception if no current Issue exists.

## Description

The `getCurrentIssue()` method returns the current Issue of the provided Brand as defined on Studio Server.

## Examples

**Get the current Issue of a Brand**

```javascript
// Get the current Issue of the Brand "WW News".
var issue = app.entSession.getCurrentIssue("WW News");
alert("Current Issue: " + issue.name + " (ID: " + issue.id + ")");
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [getIssue](./getIssue.md)
- [getPreviousIssue](./getPreviousIssue.md)
- [getNextIssue](./getNextIssue.md)
