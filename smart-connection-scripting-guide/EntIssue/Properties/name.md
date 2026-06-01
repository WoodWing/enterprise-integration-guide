---
layout: chapter
title: name
sortid: 33
permalink: 1117-name
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntIssue.name;
```

### Access

_readonly_

### Parameters

**Return value** _string_

The name of the Issue.

## Description

The `name` property returns the name of the Issue as defined on Studio Server.

## Examples

**Get the name of an Issue**

```javascript
// Get the name of an Issue on Studio Server.
var issue = app.entSession.getIssue("WW News", "1st Issue");
var issueName = issue.name;
alert("Issue name: " + issueName);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [getIssue](../../Session/Methods/getIssue.md)
- [getIssues](../../Session/Methods/getIssues.md)
