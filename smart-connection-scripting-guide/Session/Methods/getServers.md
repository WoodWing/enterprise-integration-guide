---
layout: chapter
title: getServers
sortid: 88
permalink: 1213-getServers
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Session.getServers();
```

### Parameters

**Return value** _Array of Array of string_

The returned array contains arrays of two strings: the display name and the URL of the server.

## Description

The `getServers()` method returns a list of servers from the WWSettings.xml file that can be used to login to. The dynamically retrieved server list is currently not supported by this scripting call.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
