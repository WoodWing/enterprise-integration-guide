---
layout: chapter
title: reLogin
sortid: 94
permalink: 1220-reLogin
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Session.reLogin();
```

### Parameters

**Return value**

The `reLogin()` method does not return anything. It throws an exception in case of an error.

## Description

The `reLogin()` method performs a re-login to the Studio or Enterprise Server system. Useful when changes were made to the configuration, workflow, etc on the server and those value are returned during the login.

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

When logging in on servers which have Single Sign-On (SSO) enabled, the `reLogin()` call will not work on clients except for InDesign Server.
SSO is available for all versions of Studio and the following versions of Smart Connection:

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

| Adobe Version | Supported |
|---------------|-----------|
| CC 2019       | v14.1+ ✔  |
| 2020          | ✔         |
| 2021          | ✔         |
| 2022          | ✔         |
