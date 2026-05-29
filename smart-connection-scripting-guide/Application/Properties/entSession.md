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

**Return value** _[Session](../../Session/index.md)_

The Studio Server Session object.

## Description

The `entSession` property gives access to the Studio Server session by returning a [Session](../../Session/index.md) object. Use this object to log in and out of Studio Server, retrieve session details such as the active server, URL, user, and ticket, and query server data such as publications, issues, and users.

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

**Read active session details**

```javascript
// Retrieve the current session details.
var session = app.entSession;
var server = session.activeServer;
var url    = session.activeUrl;
var user   = session.activeUser;
var ticket = session.activeTicket;

alert("Server: " + server + "\nURL: " + url + "\nUser: " + user + "\nTicket: " + ticket);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [Session](../../Session/index.md)
