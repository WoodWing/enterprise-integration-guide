---
layout: chapter
title: activeTicket
sortid: 21
permalink: 1071-activeTicket
---
# activeTicket

## Syntax

```javascript
Session.activeTicket;
```

## Description

The `activeTicket` property is used to get the ticket of the current session. It returns empty when not logged in.

For more info about the Session object please see the [entSession](../../Application/Properties/entSession.md) documentation.

## Examples

**Get the active ticket used for the current session**

When `activeTicket` is empty, there is no active session.

```javascript
// Get the active ticket used for the current session.
var sessionObject = app.entSession;
var logonTicket = sessionObject.activeTicket;
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