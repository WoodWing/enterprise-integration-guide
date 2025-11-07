---
layout: chapter
title: forkLogin
sortid: 81
permalink: 1206-forkLogin
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.forkLogin(username, ticket, server, quick, requestInfo, serverUrl, sso);
```

### Parameters

**username** _string_

The user name.

**ticket** _string_

The ticket of the existing login.

**server** _string_

Name of the location to log in to. This is the name of the entry in the server list of the WWSettings.xml file.

**quick** _boolean (Optional)_

Boolean that indicates if the login to the Studio Server system should be performed without retrieving session information or not. Default is false.

**requestInfo** _Array of string (Optional)_

The list of request information that should be obtained with the logon. When not specified all information will be requested.

**serverUrl** _string (Optional)_

URL that provides access to the Studio Server from InDesign, InCopy or InDesign Server. If the URL is not specified or empty, then the name of the server will be looked up in WWSettings.xml using the server parameter.

**sso** _boolean (Optional)_

Boolean that indicates if the login to the Studio Server system using the serverURL should be tried using the SSO protocol or not.
If the `serverURL` is not specified or empty, then the server URL is looked up in WWSettings.xml together with the ‘sso’ attribute. The `sso` parameter ignored in that case.
The default value is `true`.
Note that on InDesign Server SSO is always ignored. As a consequence the sso parameter will not have any effect on InDesign Server.

**Return value**

The `forkLogin()` method does not return anything. It throws an exception in case of an error.

## Description

The `forkLogin()` method performs a login to the Studio Server system based on an existing login.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

### Single Sign-On

The `forkLogin()` scripting call does not support Single Sign-On (SSO). When running the login scripting call on InDesign Server, SSO is always ignored for SSO enabled application servers.
In InDesign and InCopy, without specifying the `serverUrl` parameter, the `forkLogin()` scripting call will only work on SSO enabled application servers if the `sso` attribute is set to “false” for the corresponding server definition in WWSettings.xml.
If the `serverUrl` parameter is provided, then the `sso` parameter in the scripting call should be set to “false” to login to an sso enabled Studio Server.
