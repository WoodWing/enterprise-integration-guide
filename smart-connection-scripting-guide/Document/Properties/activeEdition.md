---
layout: chapter
title: activeEdition
sortid: 12
permalink: 1089-activeEdition
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Document.activeEdition;
```

### Access

*read/write*

### Parameters

**Return value** *string*

The active Edition.

## Description

The `activeEdition` property is used to get the active Edition of the current Document.
The metadata of the Document contains all possible Editions that can be set.

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