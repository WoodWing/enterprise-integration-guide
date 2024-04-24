---
layout: chapter
title: activeServer
sortid: 95
permalink: 1070-activeServer
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.activeServer;
```

### Access

_readonly_

### Parameters

**Return value** _string_

The display name of the active serer.

## Description

The `activeServer` property is used to get the display name of the server used for the current session. It returns empty when not logged in.
The name of the server will have the value of the `name` property of the `<SCEnt:ServerInfo/>` tag in the WWSettings.xml file.

For more info about the Session object please see the [entSession](../../Application/Properties/entSession.md) documentation.

## Examples

**Get the server name used for the current session**

When `activeServer` is empty, there is no active session.

```javascript
// Get the server name used for the current session.
var sessionObject = app.entSession;
var serverName = sessionObject.activeServer;

// Given in WWSettings '<SCEnt:ServerInfo name="Studio v10.5.0" url="https://server.company.net/studio/index.php"/>'
// serverUrl is now 'Studio v10.5.0'.
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |

## See also

- [entSession](../../Application/Properties/entSession.md)
