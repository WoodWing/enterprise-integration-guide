---
layout: chapter
title: length
sortid: 42
permalink: 1231-length
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntMetaData.length;
```

### Access

_readonly_

### Parameters

**Return value** _number_

The number of properties present in the metadata collection object

## Description

The `length` property is the number of properties present in the metadata collection object.

## Examples

**Iterating metadata properties**

```javascript
try {
  var doc = app.documents.item(0);

  // Access the document’s metadata
  var md = doc.entMetaData;

  // Iterate the metadata keys and values
  for (var i = 0; i < md.length; ++i) {
    var keyValue = md.item(i);
    $.writeln("Key: [" + keyValue[0] + "], Value: [" + keyValue[1] + "]");
  }

  // Access the value of a specific key
  var mdName = md.get("Core_Name");
  $.writeln("Name: [" + mdName + "]");
  var mdID = md.item("Core_ID");
  $.writeln("ID: [" + mdID + "]");
} catch (e) {
  desc = e.description;
  num = e.number;
  alert("error " + num + ": " + desc);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
