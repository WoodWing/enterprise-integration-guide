---
layout: chapter
title: login
sortid: 92
permalink: 1218-login
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Session.login(username, password, server, requestInfo);
```

### Parameters

**username** *string*

The user name.

**password** *string*

The password.

**server** *string*

Name of the location to log in to. This is the name of the entry in the server list of the WWSettings.xml file.

**requestInfo** *Array of string  (Optional)*

The list of request information that should be obtained with the logon. When not specified all information will be requested.

**Return value**

The `login()` method does not return anything. It throws an exception in case of an error.

## Description

The `login()` method performs a login to the Studio or Enterprise Server system.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC 2019       | ✔       |
| 2020          | ✔       |
| 2021          | ✔       |
| 2022          | ✔         |

### Single Sign-On

When logging in on servers which have Single Sign-On (SSO) enabled, the `login()` call will not work on clients except for InDesign Server.
SSO is available for all versions of Studio and the following versions of Smart Connection:

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

| Adobe Version | Supported |
|---------------|-----------|
| CC 2019       | v14.1+ ✔  |
| 2020          | ✔         |
| 2021          | ✔         |
| 2022          | ✔         |