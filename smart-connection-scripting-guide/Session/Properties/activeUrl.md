---
layout: chapter
title: activeUrl
sortid: 22
permalink: 1074-activeUrl
---
## Syntax

```javascript
Session.activeUrl;
```

## Description

The `activeUrl` property is used to get the URL o fthe server for the current session. It returns empty when not logged in.

For more info about the Session object please see the [entSession](../../Application/Properties/entSession.md) documentation.

## Examples

**Get the URL of the server for the current session**

When `activeUrl` is empty, there is no active session.

```javascript
// Get the URL of the server for the current session.
var sessionObject = app.entSession;
var serverUrl = sessionObject.activeUrl;

// serverUrl is now http://www.
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

* [entSession](../../Application/Properties/entSession.md)