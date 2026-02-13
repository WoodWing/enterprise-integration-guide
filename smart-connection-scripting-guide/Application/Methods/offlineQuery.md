---
layout: chapter
title: offlineQuery
sortid: 6
permalink: 1081-offlineQuery
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.offlineQuery();
```

### Parameters

**Return value** _string_

A string representing the result for the Offline query event. The result is comma separated.

## Description

The `offlineQuery()` method performs an offline query. It will list all the objects that are closed for offline usage within the application this query is done.
An offline query can be performed when a user is logged in as well as when a user is logged out.

## Examples

**Example of queryResult when there are no offline objects**

```javascript
var queryResult = app.offlineQuery();

// Columns: <int, ID><string, Name><string, Type>
//
// Rows:
```

**Example of queryResult when there are object that are closed for offline useage**

```javascript
var queryResult = app.offlineQuery();

// Columns: <int, ID><string, Name><string, Type>
//
// Rows:
// <11191, overset_layout, Layout>
//
// <15238, offline_layout, Layout>
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
