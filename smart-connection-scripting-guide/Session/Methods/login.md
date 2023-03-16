---
layout: chapter
title: login
sortid: 92
permalink: 1218-login
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.login(username, password, server, requestInfo, serverUrl, sso);
```

### Parameters

**username** _string_

The user name.

**password** _string_

The password.

**server** _string_

Name of the location to log in to. This is the name of the entry in the server list of the WWSettings.xml file.

**requestInfo** _Array of string (Optional)_

The list of request information that should be obtained with the logon. When not specified all information will be requested.

**serverUrl** _string (Optional, since 16.3.3 and 17.0.1)_

URL that provides access to the Studio Server from InDesign, InCopy or InDesign Server. If the URL is not specified or empty, then the name of the server will be looked up in WWSettings.xml using the server parameter.

**sso** _boolean (Optional, since 16.3.3 and 17.0.1)_

Boolean that indicates if the login to the Studio Server system using the serverURL should be tried using the SSO protocol or not.
If the `serverURL` is not specified or empty, then the server URL is looked up in WWSettings.xml together with the ‘sso’ attribute. The `sso` parameter ignored in that case.
The default value is `true`.
Note that on InDesign Server SSO is always ignored. As a consequence the sso parameter will not have any effect on InDesign Server.

**Return value**

The `login()` method does not return anything. It throws an exception in case of an error.

## Description

The `login()` method performs a login to the Studio or Enterprise Server system.

## Examples

**Login with servername**

```javascript
app.entSession.login("John", "JohnsPassword", "localserver");
```

**Login with URL (since 16.3.3 / 17.0.1)**

```javascript
app.entSession.login(
  "John",
  "JohnsPassword",
  "",
  new Array(),
  "https://localhost:8888/StudioServer/index.php",
  false
);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2020          | ✔         |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |

### Single Sign-On

The `login()` scripting call does not support Single Sign-On (SSO). When running the login scripting call on InDesign Server, SSO is always ignored for SSO enabled application servers.
In InDesign and InCopy, without specifying the `serverUrl` parameter, the `login()` scripting call will only work on SSO enabled application servers if the `sso` attribute is set to “false” for the corresponding server definition in WWSettings.xml.
Since Studio for InDesign and InCopy 16.3.3 and 17.0.1: If the `serverUrl` parameter is provided, then the `sso` parameter in the scripting call should be set to “false” to login to an sso enabled Studio Server.
