---
layout: chapter
title: defaultEditions
sortid: 13
permalink: 1090-defaultEditions
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Document.defaultEditions;
```

### Access

*read/write*

### Parameters

**Return value** *string[]*

A list of Edition names.

## Description

The `defaultEditions` property is used to get the list of Edition names that new page items will be assigned to on creation.

## Examples

**Example title**

```javascript
```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC 2018       | ✔       |
| CC 2019       | ✔       |
| 2020          | ✔       |
| 2021          | ✔       |