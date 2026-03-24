---
layout: chapter
title: create
sortid: 21
permalink: 1100-create
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Dossier.create();
```

### Parameters

**Return value**

Before version 19.0.4 for 2024 and version 20.0.1 for 2025 the `create()` method does not return anything.  
Starting from these versions, the `create()` method returns the newly created Dossier object.

## Description

The `create()` method creates a new Dossier object on the Studio Server.

## Examples

**Getting metadata using the initial Dossier object after creation**

```javascript
var myDossier = app.dossiers.add();
var dosMetaData = myDossier.entMetaData;

dosMetaData.set("Core_Name", "New_Dossier");
dosMetaData.set("Core_Publication", "WW Erik");
dosMetaData.set("Core_Issue", "Issue 1");
dosMetaData.set("Core_Section", "Sport");

// Creates a database object, for example, with ID 43786
myDossier.create();

// Only from v19.0.4 for 2024, v20.0.1 for 2025 and higher
alert(dosMetaData.get("Core_ID")); // 43786
```

**Getting metadata using a new Dossier object after creation**

```javascript
var myDossier = app.dossiers.add();
var dosMetaData = myDossier.entMetaData;

dosMetaData.set("Core_Name", "New_Dossier");
dosMetaData.set("Core_Publication", "WW Erik");
dosMetaData.set("Core_Issue", "Issue 1");
dosMetaData.set("Core_Section", "Sport");

// Only from v19.0.4 for 2024, v20.0.1 for 2025 and higher
// Creates a database object, for example, with ID 43786
var newDossier = myDossier.create();
var newDosMetaData = newDossier.entMetaData;

alert(newDosMetaData.get("Core_ID")); // 43786
```

## Supported versions

| Adobe Version | Supported | Returns created Dossier object |
| ------------- | --------- | ------------------------------ |
| 2023          | ✔         |                                |
| 2024          | ✔         | ✔ v19.0.3 and up               |
| 2025          | ✔         | ✔ v20.0.1 and up               |
| 2026          | ✔         | ✔                              |
