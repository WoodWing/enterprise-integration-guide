---
layout: chapter
title: reLogin
sortid: 94
permalink: 1220-reLogin
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.reLogin();
```

### Parameters

**Return value**

The `reLogin()` method does not return a value. It throws an exception in case of an error.

## Description

The `reLogin()` method performs a re-login to the Studio Server system. Useful when changes were made to the configuration, workflow, etc on the server and those values are returned during the login.

## Examples

**Re-login to refresh session data**

```javascript
// Re-login to pick up configuration changes made on the server.
app.entSession.reLogin();
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

### Single Sign-On

When logging in on servers which have Single Sign-On (SSO) enabled, the `reLogin()` call will not work on clients except for InDesign Server.
SSO is available for all versions of Studio and the following versions of Studio for InDesign and InCopy:

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
