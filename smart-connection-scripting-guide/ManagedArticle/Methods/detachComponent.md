---
layout: chapter
title: detachComponent
sortid: 55
permalink: 1139-detachComponent
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
ManagedArticle.detachComponent(pageItem);
```

### Parameters

**pageItem** *PageItem, Story*

Page item, or Story, that needs to be removed from the multi-component Article.

**Return value**

The `detachComponent()` method does not return anything.

## Description

The `detachComponent()` method detaches a component from the layout and deletes the component from a multi-component Article. The last placed component of the Article cannot be detached and deleted using this method.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |
| 2020          | ✔       |