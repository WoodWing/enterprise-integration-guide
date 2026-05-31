---
layout: chapter
title: add
sortid: 27
permalink: 1110-add
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Dossiers.add();
```

### Parameters

**Return value** _[Dossier](../../Dossier/index.md)_

The newly created Dossier scripting object.

## Description

The `add()` method creates a new [Dossier](../../Dossier/index.md) scripting object and adds it to the Dossiers collection. The Dossier is not yet persisted to Studio Server at this point. Call `create()` on the returned Dossier object to save it to Studio Server.

## Examples

**Create a new dossier on Studio Server**

```javascript
// Add a new Dossier scripting object to the collection.
var dossier = app.dossiers.add();

// Set the metadata for the new dossier.
dossier.entMetaData.set("Core_Name", "My New Dossier");
dossier.entMetaData.set("Core_Publication", "WW News");
dossier.entMetaData.set("Core_Issue", "1st Issue");
dossier.entMetaData.set("Core_Section", "Sport");

// Persist the dossier to Studio Server.
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

- [Dossier.create()](../../Dossier/Methods/create.md)
