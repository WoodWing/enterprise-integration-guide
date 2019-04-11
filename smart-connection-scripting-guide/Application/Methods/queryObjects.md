---
layout: chapter
title: queryObjects
sortid: 7
permalink: 1083-queryObjects
---
## Syntax

![](../../images/indesign.png "InDesign") ![](../../images/incopy.png "InCopy") ![](../../images/indesignserver.png "InDesign Server")
```javascript
app.queryObjects(criteria);
```

### Parameters

**criteria** *string[]*

The query criteria in the form of `<key, value>` pairs
```javascript
criteria[0] = 'Brand, WW News';
criteria[1] = 'Issue, 2nd Issue';
...
```

**Return value** *string*

A string representing the query result.

## Description

The `queryObjects()` method performs a user query based in the passed criteria.

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