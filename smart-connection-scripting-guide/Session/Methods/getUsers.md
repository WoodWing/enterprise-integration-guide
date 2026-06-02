---
layout: chapter
title: getUsers
sortid: 91
permalink: 1216-getUsers
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getUsers();
```

### Parameters

**Return value** _Array of Array of string_

The returned array contains arrays of two strings: the user's short name and the user's full name.

## Description

The `getUsers()` method returns a list of users as defined on Studio Server.

## Examples

**Get all users**

```javascript
// Get all users from Studio Server.
var users = app.entSession.getUsers();
for (var i = 0; i < users.length; i++) {
    alert("User: " + users[i][0] + " (" + users[i][1] + ")");
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
