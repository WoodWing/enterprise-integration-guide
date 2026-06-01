---
layout: chapter
title: has
sortid: 36
permalink: 1224-has
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntMetaData.has(key);
```

### Parameters

**key** _string_

The property key.

**Return value** _boolean_

`true` if the property with the given key exists, `false` otherwise.

## Description

The `has()` method returns `true` if the property with the given key exists in the metadata collection, or `false` if it does not.

## Examples

**Check whether the document is managed by Studio Server**

```javascript
// Check if the active document has a Studio Server ID.
var md = app.activeDocument.entMetaData;
if (md.has("Core_ID")) {
    var id = md.get("Core_ID");
    alert("Document is managed by Studio Server with ID: " + id);
} else {
    alert("Document is not managed by Studio Server.");
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
