---
layout: chapter
title: namedQuery
sortid: 4
permalink: 1080-namedQuery
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
app.namedQuery(queryName [, filename] [, fileType]);
```

### Parameters

**queryName** *string*

The name of the query

**fileName** *string (Optional)*

The name of the object or file.

**fileType** *string (Optional)*

The type of th object or file.

**Return value** *string*

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
|---------------|-----------|
| CC 2019       | ✔         |
| 2020          | ✔         |
| 2021          | ✔         |
| 2022          | ✔         |
