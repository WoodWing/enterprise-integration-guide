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

The `reLogin()` method performs a re-login to the Enterprise system. Useful when changes were made to the configuration, workflow, etc on the server and those value are returned during the login. 

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