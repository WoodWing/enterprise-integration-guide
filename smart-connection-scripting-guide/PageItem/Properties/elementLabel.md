---
layout: chapter
title: elementLabel
sortid: 76
permalink: 1237-elementLabel
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
PageItem.elementLabel;
```

### Access

*read/write*

### Parameters

**Return value** *string*

The name of the Element Label.

## Description

The Element Label assigned to the page item. When assigning to
a text frame, all threaded text frames will get the same Element
Label.

## Examples

**Example title**

```javascript
```

## Support versions

| Adobe Version | Support |
|---------------|---------|
| CC            | ✔       |
| CC 2014       | ✔       |
| CC 2015       | ✔       |
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |
| 2020          | ✔       |