---
layout: chapter
title: create
sortid: 53
permalink: 1137-create
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedArticle.create(pageItems [, stationary]);
```

### Parameters

**pageItems** _PageItem[]_

The Page items that will form the Article.

**stationary** _boolean (Optional)_

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
| ------------- | --------- |
| 2020          | ✔         |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
