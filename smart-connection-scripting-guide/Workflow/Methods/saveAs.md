---
layout: chapter
title: saveAs
sortid: 104
permalink: 1239-saveAs
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Workflow.saveAs();
```

### Parameters

**Return value** *Document*

The newly created Document object.

## Description

The `saveAs()` method stores the document as a new object in the Enterprise or Studio Server system. Throws an exception in case of an error. Change the metadata before calling saveAs.

Use the “Type” key in the EntMetaData to indicate what kind of object should be cre- ated. Possible values are: “Layout”, “Layout Template”, “Layout Module” or “Layout Module Template”.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |
| 2021          | ✔         |