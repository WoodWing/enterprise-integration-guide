---
layout: chapter
title: create
sortid: 53
permalink: 1137-create
---
## Syntax 

![](../../images/indesign.png "InDesign") ![](../../images/indesignserver.png "InDesign Server")
```javascript
ManagedArticle.create(pageItems [, stationary]);
```

### Parameters

**pageItems** *PageItem[]*

The Page items that will form the Article.

**stationary** *boolean (Optional)*

If set to `true`, an Article Template will be created instead of an Article. Default is `false`.

**Return value**

The `create()` method does not return anything.

## Description

The `create()` method creates a placed Article from the given page items. Depending on the system configuration, the given page item can contain images which become part of the Article.

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