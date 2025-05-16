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

**Return value** _Document_

The newly created Document object.

## Description

The `saveAs()` method stores the document as a new object in the Studio or Enterprise Server system. Throws an exception in case of an error. Change the metadata before calling saveAs.

Use the “Type” key in the EntMetaData to indicate what kind of object should be created. Possible values are: “Layout”, “LayoutTemplate”, “LayoutModule” or “LayoutModuleTemplate”.

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
