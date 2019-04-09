---
layout: chapter
title: login
sortid: 61
permalink: 1218-login
---
## Syntax

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

The `login()` method performs a login to the Enterprise system. 

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
