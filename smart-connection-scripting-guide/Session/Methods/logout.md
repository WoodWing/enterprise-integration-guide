---
layout: chapter
title: logout
sortid: 93
permalink: 1219-logout
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.logout();
```

### Parameters

**Return value**

The `logout()` method does not return a value. It throws an exception in case of an error.

## Description

The `logout()` method performs a logout from the Studio Server system.

## Examples

**Log out from Studio Server**

```javascript
// Log out from Studio Server.
app.entSession.logout();
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
