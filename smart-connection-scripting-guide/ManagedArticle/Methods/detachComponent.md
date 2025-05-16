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

**pageItem** _PageItem, Story_

Page item, or Story, that needs to be removed from the multi-component Article.

**Return value**

The `detachComponent()` method does not return anything.

## Description

The `detachComponent()` method detaches a component from the layout and deletes the component from a multi-component Article. The last placed component of the Article cannot be detached and deleted using this method. The functionality is similar to the 'Detach and Delete Component from Article' menu.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
