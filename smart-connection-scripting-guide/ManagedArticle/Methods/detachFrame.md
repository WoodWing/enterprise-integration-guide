---
layout: chapter
title: detachFrame
sortid: 56
permalink: 1140-detachFrame
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
ManagedArticle.detachFrame(pageItem);
```

### Parameters

**pageItem** *PageItem, Story*

Page item, or Story, that will be detached if it is a multiple placed Article component.
If the passed page item is not a multiple placed Article component the Error Code "The object cannot be detached." will be returned.

**Return value**

The `detachFrame()` method does not return anything.

## Description

The `detachFrame()` method detaches a frame from a multi-component Article.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC            | ✔       |
| CC 2014       | ✔       |
| CC 2015       | ✔       |
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |
| 2020          | ✔       |