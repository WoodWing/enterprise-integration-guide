---
layout: chapter
title: quickLogin
sortid: 100
permalink: 1264-quickLogin
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.quickLogin(username, password, server [, serverUrl] [, sso]);
```

### Parameters

**username** _string_

The user name.

**password** _string_

The password.

**server** _string_

Name of the location to log in to. This is the name of the entry in the server list of the WWSettings.xml file.

**serverUrl** _string (Optional)_

URL that provides access to the Studio Server from InDesign, InCopy or InDesign Server. If the URL is not specified or empty, then the name of the server will be looked up in WWSettings.xml using the server parameter.

**sso** _boolean (Optional)_

Boolean that indicates if the login to the Studio Server system using the serverURL should be tried using the SSO protocol or not.
If the `serverURL` is not specified or empty, then the server URL is looked up in WWSettings.xml together with the 'sso' attribute. The `sso` parameter ignored in that case.
The default value is `true`.
Note that on InDesign Server SSO is always ignored. As a consequence the sso parameter will not have any effect on InDesign Server.

**Return value**

The `quickLogin()` method does not return a value. It throws an exception in case of an error.

## Description

The `quickLogin()` method performs a login to the Studio Server system without retrieving session information. This makes it faster than a regular `login()` call. Use this method when you do not need session details such as publications, users, or workflow data after logging in.

## Examples

**Quick login with a server name**

```javascript
// Log in without retrieving session information.
app.entSession.quickLogin("John", "JohnsPassword", "localserver");
```

**Quick login with a URL**

```javascript
// Quick login using a server URL instead of a server name.
app.entSession.quickLogin(
  "John",
  "JohnsPassword",
  "",
  "https://localhost:8888/StudioServer/index.php",
  false
);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [login](./login.md)
- [forkLogin](./forkLogin.md)
