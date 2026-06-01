---
layout: chapter
title: remove
sortid: 40
permalink: 1228-remove
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntMetaData.remove(key);
```

### Parameters

**key** _string_

The property key.

**Return value**

The `remove()` method does not return a value.

## Description

The `remove()` method removes the property with the given key from the collection. If the key does not exist, the operation completes without error.

## Examples

**Remove a custom metadata property**

```javascript
// Remove a custom property from the metadata of the active document.
var md = app.activeDocument.entMetaData;
md.remove("C_MYPROPERTY");
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
