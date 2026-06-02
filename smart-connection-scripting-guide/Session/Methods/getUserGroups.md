---
layout: chapter
title: getUserGroups
sortid: 90
permalink: 1215-getUserGroups
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getUserGroups();
```

### Parameters

**Return value** _Array of string_

The returned array is a list of user group names.

## Description

The `getUserGroups()` method returns a list of user group names as defined on Studio Server.

## Examples

**Get all user groups**

```javascript
// Get all user group names from Studio Server.
var groups = app.entSession.getUserGroups();
alert("User groups: " + groups.join(", "));
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
