---
layout: chapter
title: count
sortid: 34
permalink: 1222-count
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntMetaData.count();
```

### Parameters

**Return value** _number_

The number of properties present in the metadata collection object.

## Description

The `count()` method returns the number of properties present in the metadata collection object.

## Examples

**Count the metadata properties of the active document**

```javascript
// Count the metadata properties of the active document.
var md = app.activeDocument.entMetaData;
var count = md.count();
alert("Number of metadata properties: " + count);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
