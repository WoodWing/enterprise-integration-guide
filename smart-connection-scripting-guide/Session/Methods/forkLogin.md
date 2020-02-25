---
layout: chapter
title: forkLogin
sortid: 81
permalink: 1206-forkLogin
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Session.forkLogin(username, ticket, server, quick, requestInfo);
```

### Parameters

**username** *string*

The user name.

**ticket** *string* 

The ticket of the existing login.

**server** *string* 

Name of the location to log in to. This is the name of the entry in the server list of the WWSettings.xml file.

**quick** *boolean (Optional)*

*(Introduced in CC 2014)* Boolean that indicates if the login to the Enterprise system should be performed without retrieving session information or not. Default is false.

**requestInfo** *Array of string  (Optional)*

*(Introduced in CC 2014)* The list of request information that should be obtained with the logon. When not specified all information will be requested.

**Return value**

The `forkLogin()` method does not return anything. It throws an exception in case of an error.

## Description

The `forkLogin()` method performs a login to the Enterprise system based on an existing login.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC            | ✔         |
| CC 2014       | ✔         |
| CC 2015       | ✔         |
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |

### Single Sign-On

When logging in on servers which have Single Sign-On (SSO) enabled, the `forkLogin()` call will not work on clients except for InDesign Server.
SSO is available for the following Smart Connection versions:

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

| Adobe Version | Supported |
|---------------|-----------|
| CC 2017       | v12.3+ ✔  |
| CC 2018       | v13.1+ ✔  |
| CC 2019       | v14.1+ ✔  |
| 2020          | ✔         |