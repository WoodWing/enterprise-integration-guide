---
layout: chapter
title: namedQuery
sortid: 5
permalink: 1080-namedQuery
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.namedQuery(queryName [, filename] [, fileType]);
```

### Parameters

**queryName** _string_

The name of the query

**fileName** _string (Optional)_

The name of the object or file.

**fileType** _string (Optional)_

The type of th object or file.

**Return value** _string_

A string representing the Browse query result.
The result is comma separated.

## Description

The `namedQuery()` method performs a named query. It can be used for the Inbox, Templates and NameSearch queries.

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
