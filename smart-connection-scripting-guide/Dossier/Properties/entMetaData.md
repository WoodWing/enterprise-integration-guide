---
layout: chapter
title: entMetaData
sortid: 26
permalink: 1106-entMetaData
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Dossier.entMetaData;
```

### Access

_readonly_

### Parameters

**Return value** _[EntMetaData](../../EntMetaData/index.md)_

The Studio Server metadata object associated with the Dossier.

## Description

The `entMetaData` property returns an [EntMetaData](../../EntMetaData/index.md) object that provides access to the Studio Server metadata associated with the Dossier. Use this object to read or set metadata values such as the dossier name, brand, issue, and custom properties.

## Examples

**Read metadata of a dossier**

```javascript
// Retrieve a dossier and read its metadata.
var dossier = app.dossiers.retrieve("456");
var name = dossier.entMetaData.get("Core_Name");
var brand = dossier.entMetaData.get("Core_Publication");
alert("Dossier '" + name + "' belongs to brand '" + brand + "'.");
```

**Set metadata before creating a new dossier**

```javascript
// Create a new dossier object and set its metadata before saving to Studio Server.
var dossier = app.dossiers.add();
dossier.entMetaData.set("Core_Name", "New Dossier");
dossier.entMetaData.set("Core_Publication", "WW News");
dossier.entMetaData.set("Core_Issue", "1st Issue");
dossier.entMetaData.set("Core_Section", "Sport");
dossier.create();
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [EntMetaData](../../EntMetaData/index.md)
