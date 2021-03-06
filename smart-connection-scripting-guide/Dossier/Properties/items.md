---
layout: chapter
title: items
sortid: 28
permalink: 1108-items
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Dossier.items;
```

### Access

*readonly*

### Parameters

**Return value** *string[]*

A string of Enterprise or Studio Server object IDs.

## Description

The `items` property is used to get a list of IDs of Enterprise or Studio Server objects which are residing in the current Dossier.

## Examples

**Example title**

```javascript
```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC 2018       | ✔       |
| CC 2019       | ✔       |
| 2020          | ✔       |
| 2021          | ✔       |