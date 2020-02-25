---
layout: chapter
title: checkIn
sortid: 101
permalink: 1173-checkIn
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Workflow.checkIn();
```

### Parameters

**Return value**

The `checkIn()` method does not return anything.

## Description

The `checkIn()` method checks the document in to the Enterprise system.

Use the “Type” key in the EntMetaData to indicate what kind of object should be created. Possible values are: “Layout”, “Layout Template”, “Layout Module” or “Layout Module Template”.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |