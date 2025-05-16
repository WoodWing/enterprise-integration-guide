---
layout: chapter
title: activeUser
sortid: 98
permalink: 1075-activeUser
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.activeUser;
```

### Access

_readonly_

### Parameters

**Return value** _string_

The (short) user name.

## Description

The `activeUser` property is used to get the user's short name of the user currently logged in. It returns empty when not logged in.

For more info about the Session object please see the [entSession](../../Application/Properties/entSession.md) documentation.

## Examples

**Get the name of the user currently logged in**

When `activeUser` is empty, there is no active session.

```javascript
// Get the name of the user currently logged in.
var sessionObject = app.entSession;
var userShortName = sessionObject.activeUser;

// userShortName is now 'Joe'.
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |

## See also

- [entSession](../../Application/Properties/entSession.md)
