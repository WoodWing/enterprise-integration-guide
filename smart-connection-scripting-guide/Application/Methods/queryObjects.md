---
layout: chapter
title: queryObjects
sortid: 10
permalink: 1084-queryObjects
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.queryObjects(criteria);
```

### Parameters

**criteria** _string[]_

The query criteria in the form of `<key, value>` pairs

```javascript
criteria[0] = 'Brand, WW News';
criteria[1] = 'Issue, 2nd Issue';
...
```

**Return value** _string_

A string representing the query result.

## Description

The `queryObjects()` method performs a user query based in the passed criteria.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
