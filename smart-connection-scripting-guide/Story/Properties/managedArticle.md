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

*readonly*

### Parameters

**Return value** *ManagedArticle*

The managed article scripting object.

## Description

The `managedArticle` property is used to obtain access to the associated ManagedArticle scripting object. Returns nothing if there is no object associated.
For more info about the Managed Article object please see the [ManagedArticle](../../ManagedArticle/index.md) documentation.

## Examples


## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |
| 2021          | ✔         |

## See also

* [ManagedArticle](../../ManagedArticle/index.md)