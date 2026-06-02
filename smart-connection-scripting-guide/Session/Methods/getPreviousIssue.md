---
layout: chapter
title: getPreviousIssue
sortid: 104
permalink: 1268-getPreviousIssue
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getPreviousIssue(brandName);
```

### Parameters

**brandName** _string_

The name of the Brand.

**Return value** _[EntIssue](../../EntIssue/index.md)_

Returns the previous Issue of the provided Brand. Throws an exception if no previous Issue exists.

## Description

The `getPreviousIssue()` method returns the previous Issue of the provided Brand as defined on Studio Server.

## Examples

**Get the previous Issue of a Brand**

```javascript
// Get the previous Issue of the Brand "WW News".
var issue = app.entSession.getPreviousIssue("WW News");
alert("Previous Issue: " + issue.name + " (ID: " + issue.id + ")");
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
- [getNextIssue](./getNextIssue.md)
