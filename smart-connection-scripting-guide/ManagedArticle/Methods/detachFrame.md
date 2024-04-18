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

**pageItems** _PageItem[]_

The page items that will be detached from the article. If the passed page item is the last placed component of the Article the Error Code "The object cannot be detached." will be returned.

**Return value**

The `detachFrame()` method does not return anything.

## Description

The `detachFrame()` method detaches frames from a multi-component Article. The last placed component of the Article cannot be detached using this method. The functionality is similar to the 'Detach Component' menu.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
