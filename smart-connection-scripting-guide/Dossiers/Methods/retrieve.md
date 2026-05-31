---
layout: chapter
title: retrieve
sortid: 30
permalink: 1113-retrieve
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Dossiers.retrieve(id);
```

### Parameters

**id** _string_

The object ID of the Dossier to retrieve from Studio Server.

**Return value** _[Dossier](../../Dossier/index.md)_

The retrieved Dossier object.

## Description

The `retrieve()` method fetches an existing Dossier from Studio Server by its object ID and adds it to the Dossiers collection. The returned [Dossier](../../Dossier/index.md) object is populated with the metadata and items from Studio Server.

## Examples

**Retrieve a dossier and read its name**

```javascript
// Retrieve an existing dossier from Studio Server.
var dossier = app.dossiers.retrieve("456");
var name = dossier.entMetaData.get("Core_Name");
alert("Dossier name: " + name);
```

**Retrieve a dossier and list its items**

```javascript
// Retrieve a dossier and display all item IDs it contains.
var dossier = app.dossiers.retrieve("456");
var items = dossier.items;
for (var i = 0; i < items.length; i++) {
    alert("Item ID: " + items[i]);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
