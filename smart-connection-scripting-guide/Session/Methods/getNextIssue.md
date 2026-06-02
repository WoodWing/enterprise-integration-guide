---
layout: chapter
title: getNextIssue
sortid: 105
permalink: 1269-getNextIssue
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getNextIssue(brandName);
```

### Parameters

**brandName** _string_

The name of the Brand.

**Return value** _[EntIssue](../../EntIssue/index.md)_

Returns the next Issue of the provided Brand. Throws an exception if no next Issue exists.

## Description

The `getNextIssue()` method returns the next Issue of the provided Brand as defined on Studio Server.

## Examples

**Get the next Issue of a Brand**

```javascript
// Get the next Issue of the Brand "WW News".
var issue = app.entSession.getNextIssue("WW News");
alert("Next Issue: " + issue.name + " (ID: " + issue.id + ")");
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
- [getCurrentIssue](./getCurrentIssue.md)
- [getPreviousIssue](./getPreviousIssue.md)
