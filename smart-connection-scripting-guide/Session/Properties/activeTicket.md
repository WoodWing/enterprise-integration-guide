---
layout: chapter
title: activeTicket
sortid: 96
permalink: 1071-activeTicket
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.activeTicket;
```

### Access

_readonly_

### Parameters

**Return value** _string_

The ticket of the current session.

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

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |

## See also

- [entSession](../../Application/Properties/entSession.md)
