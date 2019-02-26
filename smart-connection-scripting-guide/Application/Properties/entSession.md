---
layout: chapter
title: entSession
sortid: 10
permalink: 1066-entSession
---
## Syntax

```javascript
app.entSession;
```

## Description

The `entSession` property gives access to the Enterprise session by returning a Session object.

For more info about the Session object please see the [Session](../../Session/index.md) documentation.

## Examples

**Check if there is an active session**

When `activeUrl` is empty, there is no active session.

```javascript
// Check if the session is active.
var sessionObject = app.entSession;
var activeSession = (sessionObject.activeUrl !== "");

// When logged in, activeSession is now 'true'.
// When not logged in, activeSession is 'false'.
```

## Support versions

| Adobe Version | Support |
|---------------|---------|
| CC            | ✔       |
| CC 2014       | ✔       |
| CC 2015       | ✔       |
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |

## See also

* [Session](../../Session/index.md)