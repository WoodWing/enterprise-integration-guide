---
layout: chapter
title: allIndesignArticleIds
sortid: 74
permalink: 1235-allIndesignArticleIds
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
PageItem.allIndesignArticleIds;
```

### Access

*readonly*

### Parameters

**Return value** *Array of String*

The IDs of all InDesign Articles to which the page item
belongs.

## Description

Returns the IDs of all InDesign Articles to which the page item
belongs. The IDs of InDesign Articles that contain a parent
group item of the page item will also be returned. This differs
from the PageItem.allArticles call.

## Examples

**Example title**

```javascript
```

## Support versions

| Adobe Version | Support |
|---------------|---------|
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |
| 2020          | ✔       |