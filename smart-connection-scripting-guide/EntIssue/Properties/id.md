---
layout: chapter
title: id
sortid: 31
permalink: 1115-id
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntIssue.id;
```

### Access

_readonly_

### Parameters

**Return value** _string_

The Studio Server object ID of the Issue.

## Description

The `id` property returns the unique object ID of the Issue as stored on Studio Server.

## Examples

**Get the ID of an Issue**

```javascript
// Get the ID of an Issue on Studio Server.
var issue = app.entSession.getIssue("WW News", "1st Issue");
var issueId = issue.id;
alert("Issue ID: " + issueId);
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
