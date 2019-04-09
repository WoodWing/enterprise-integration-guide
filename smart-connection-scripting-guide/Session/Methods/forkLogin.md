---
layout: chapter
title: forkLogin
sortid: 61
permalink: 1206-forkLogin
---
## Syntax

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

Boolean that indicates if the login to the Enterprise system should be performed without retrieving session information or not. Default is false.

**requestInfo** *Array of string  (Optional)*

The list of request information that should be obtained with the logon. When not specified all information will be requested.

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
|---------------|---------|
| CC            | ✔       |
| CC 2014       | ✔       |
| CC 2015       | ✔       |
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |