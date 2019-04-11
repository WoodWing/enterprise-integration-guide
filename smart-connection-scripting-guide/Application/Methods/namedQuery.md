---
layout: chapter
title: namedQuery
sortid: 4
permalink: 1080-namedQuery
---
## Syntax

![](../../images/indesign.png "InDesign") ![](../../images/incopy.png "InCopy") ![](../../images/indesignserver.png "InDesign Server")
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
| CC            | ✔         |
| CC 2014       | ✔         |
| CC 2015       | ✔         |
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |