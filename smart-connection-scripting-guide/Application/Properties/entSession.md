---
layout: chapter
title: entSession
sortid: 11
permalink: 1087-entSession
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.entSession;
```

### Access

_readonly_

### Parameters

**Return value** _Session_

The Studio or Enterprise Server Session object.

## Description

The `entSession` property gives access to the Studio or Enterprise Server session by returning a Session object.

For more info about the Session object please see the [Session](../../Session/index.md) documentation.

## Examples

**Check if there is an active session**

When `activeUrl` is empty, there is no active session.

```javascript
// Check if the session is active.
var sessionObject = app.entSession;
var activeSession = sessionObject.activeUrl !== "";

// When logged in, activeSession is now 'true'.
// When not logged in, activeSession is 'false'.
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |

## See also

- [Session](../../Session/index.md)
