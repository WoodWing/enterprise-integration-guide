---
layout: chapter
title: get
sortid: 35
permalink: 1223-get
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntMetaData.get(key);
```

### Parameters

**key** _string_

The property key.

**Return value**

**_*2022, 2023, 2024 up to and including 19.0.5, 2024*_** _string, Array of string, number, Array of number, boolean or Array of boolean_

**_*2024 from 19.0.6 onwards*_** _string, Array of string_

The property value for the given key. If the key does not exist, an error will be thrown.

## Description

The `get()` method returns the property value for the given key.

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

| Adobe Version | Supported | Description                                                                             |
| ------------- | --------- | --------------------------------------------------------------------------------------- |
| 2022          | ✔         | Returns string, Array of string, number, Array of number, boolean, or Array of boolean. |
| 2023          | ✔         | Returns string, Array of string, number, Array of number, boolean, or Array of boolean. |
| 2024          | ✔         | From v19.0.6 onwards, returns string or Array of string.                                |
| 2025          | ✔         |
