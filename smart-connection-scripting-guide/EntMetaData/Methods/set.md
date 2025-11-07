---
layout: chapter
title: set
sortid: 41
permalink: 1229-set
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntMetaData.set(key, value);
```

### Parameters

**key** _string_

**value**

**<span style="font-size:90%;">_2023, 2024 up to and including 19.0.5, 2025 up to and including 20.0.2_</span>**

`string, Array of string, number, Array of number, boolean or Array of boolean`

**<span style="font-size:90%;">_2024 from 19.0.6 onwards, 2025 from 20.0.3 onwards_</span>**

`string`

**Return value**

The `set()` method does not return anything.

## Description

The `set()` method adds or changes the passed property.

## Examples

**Example title**

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

  md.set("C_CUSTOM_BOOLEAN", "true");

  var mdID = md.item("Core_ID");
  $.writeln("ID: [" + mdID + "]");
} catch (e) {
  desc = e.description;
  num = e.number;
  alert("error " + num + ": " + desc);
}
```

## Supported versions

| Adobe Version | Supported | Description                                                                                     |
| ------------- | --------- | ----------------------------------------------------------------------------------------------- |
| 2023          | ✔         | _value_ accepts string, Array of string, number, Array of number, boolean, or Array of boolean. |
| 2024          | ✔         | From v19.0.6 onwards, _value_ accepts string or Array of string.                                |
| 2025          | ✔         | From v20.0.3 onwards, _value_ accepts string or Array of string.                                |
| 2026          | ✔         | _value_ accepts string or Array of string.                                                      |
