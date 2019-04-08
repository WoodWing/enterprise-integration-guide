---
layout: chapter
title: entSession
sortid: 12
permalink: 1087-entSession
---
## Syntax

```javascript
app.entSession;
```

### Access

*readonly*

### Parameters

**Return value** *Session*

The Enterprise Session object.

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

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC            | ✔       |
| CC 2014       | ✔       |
| CC 2015       | ✔       |
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |

## See also

* [Session](../../Session/index.md)