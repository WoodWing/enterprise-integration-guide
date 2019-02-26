---
layout: chapter
title: activeServer
sortid: 20
permalink: 1070-activeServer
---
## Syntax

```javascript
Session.activeServer;
```

## Description

The `activeServer` property is used to get the display name of the server used for the current session. It returns empty when not logged in.

For more info about the Session object please see the [entSession](../../Application/Properties/entSession.md) documentation.

## Examples

**Get the server name used for the current session**

When `activeServer` is empty, there is no active session.

```javascript
// Get the server name used for the current session.
var sessionObject = app.entSession;
var serverName = sessionObject.activeServer;
```

## Support versions

| Adobe Version | Support |
|---------------|---------|
| CC            | ✔       |
| CC 2014       | ✔       |
| CC 2015       | ✔       |
| CC 2017       | ✔       |
| CC 2018       | ✔       |

## See also

* [entSession](../../Application/Properties/entSession.md)