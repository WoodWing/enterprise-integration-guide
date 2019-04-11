---
layout: chapter
title: saveAs
sortid: 104
permalink: 1239-saveAs
---
## Syntax

![](../../images/indesign.png "InDesign") ![](../../images/incopy.png "InCopy") ![](../../images/indesignserver.png "InDesign Server")
```javascript
Workflow.saveAs();
```

### Parameters

**Return value** *Document*

The newly created Document object.

## Description

The `saveAs()` method stores the document as a new object in the Enterprise system. Throws an exception in case of an error. Change the metadata before calling saveAs.

Use the “Type” key in the EntMetaData to indicate what kind of object should be cre- ated. Possible values are: “Layout”, “Layout Template”, “Layout Module” or “Layout Module Template”.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC            | ✔         |
| CC 2014       | ✔         |
| CC 2015       | ✔         |
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |