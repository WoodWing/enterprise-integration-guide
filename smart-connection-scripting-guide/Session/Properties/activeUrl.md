---
layout: chapter
title: activeUrl
sortid: 97
permalink: 1074-activeUrl
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.activeUrl;
```

### Access

_readonly_

### Parameters

**Return value** _string_

The URL of the active server.

## Description

The `activeUrl` property is used to get the URL of the server for the current session. It returns empty when not logged in.
The URL of the server will have the value of the `url` property of the `<SCEnt:ServerInfo/>` tag in the WWSettings.xml file.

For more info about the Session object please see the [entSession](../../Application/Properties/entSession.md) documentation.

## Examples

**Get the URL of the server for the current session**

When `activeUrl` is empty, there is no active session.

```javascript
// Get the URL of the server for the current session.
var sessionObject = app.entSession;
var serverUrl = sessionObject.activeUrl;

// Given in WWSettings '<SCEnt:ServerInfo name="Studio v10.5.0" url="https://server.company.net/studio/index.php"/>'
// serverUrl is now 'https://server.company.net/studio/index.php'.
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
