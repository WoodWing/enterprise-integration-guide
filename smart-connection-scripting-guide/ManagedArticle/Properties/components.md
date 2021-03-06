---
layout: chapter
title: components
sortid: 59
permalink: 1144-components
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
ManagedArticle.components;
```

### Access

*readonly*

### Parameters

**Return value** *PageItem[], Story*

An array of PageItem objects or a Story.

## Description

The `components` property is used to get access to the InDesign page items and stories that are the components of the current Article.

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