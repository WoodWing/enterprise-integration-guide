---
layout: chapter
title: managedArticle
sortid: 99
permalink: 1170-managedArticle
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Story.managedArticle;
```

### Access

_readonly_

### Parameters

**Return value** _[ManagedArticle](../../ManagedArticle/index.md)_

The associated ManagedArticle object, or `undefined` if the story is not bound to a managed article on Studio Server.

## Description

The `managedArticle` property returns the [ManagedArticle](../../ManagedArticle/index.md) object associated with this story, or `undefined` if the story is not part of a managed article on Studio Server.

## Examples

**Check whether a story is a managed article component**

```javascript
// Check whether the first story in the active document is a managed article component.
var story = app.activeDocument.stories[0];
var article = story.managedArticle;
if (article) {
    var name = article.entMetaData.get("Core_Name");
    alert("Managed article: " + name);
} else {
    alert("Story is not a managed article component.");
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [ManagedArticle](../../ManagedArticle/index.md)
