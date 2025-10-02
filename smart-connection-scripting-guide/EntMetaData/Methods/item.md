---
layout: chapter
title: item
sortid: 38
permalink: 1226-item
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntMetaData.item(index);
```

### Parameters

**index** _number or string_

The index (number) or name (string) of the metadata item in the metadata object.

**Return value** Array

**<span style="font-size:90%;">_2022, 2023, 2024 up to and including 19.0.5, 2025 up to and including 20.0.2_</span>**

```
Array[0] (property key): string
Array[1] (property value): string, string[], number, number[], boolean or boolean[]
```

**<span style="font-size:90%;">_2024 from 19.0.6 onwards, 2025 from 20.0.3 onwards_</span>**

```
Array[0] (property key): string
Array[1] (property value): string or string[]
```

## Description

The `item()` method returns the property value for the given index or key name.

## Examples

**Example title**

```javascript
try {
  var doc = app.documents.item(0);

  // Access the document’s metadata
  var md = doc.entMetaData;

  // Get the item by property name.
  var idItem = md.item("Core_ID");
  alert("idItem key: [" + idItem[0] + "]"); // Core_ID
  alert("idItem value: [" + idItem[1] + "]"); // 7635

  // Get the item by property name.
  var nameItem = md.item("Core_Name");
  alert("idName key: [" + nameItem[0] + "]"); // Core_Name
  alert("idName value: [" + nameItem[1] + "]"); // "TestDocument"
} catch (e) {
  desc = e.description;
  num = e.number;
  alert("error " + num + ": " + desc);
}
```

## Supported versions

| Adobe Version | Supported | Description                                                                                                         |
| ------------- | --------- | ------------------------------------------------------------------------------------------------------------------- |
| 2022          | ✔         | Returns Array of [string, string \| Array of string \| number \| Array of number \| boolean \| or Array of boolean] |
| 2023          | ✔         | Returns Array of [string, string \| Array of string \| number \| Array of number \| boolean \| or Array of boolean] |
| 2024          | ✔         | From v19.0.6 onwards, returns Array of [string, string \| Array of string].                                         |
| 2025          | ✔         | From v20.0.3 onwards, returns Array of [string, string \| Array of string].                                         |
