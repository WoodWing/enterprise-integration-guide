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

*readonly*

### Parameters

**Return value** *string*

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

// Given in WWSettings '<SCEnt:ServerInfo name="Enterprise v10.5.0" url="https://server.company.net/enterprise/index.php"/>'
// serverUrl is now 'https://server.company.net/enterprise/index.php'.
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
| 2020          | ✔       |

## See also

* [entSession](../../Application/Properties/entSession.md)