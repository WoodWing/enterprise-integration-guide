---
layout: chapter
title: getDossiersForItem
sortid: 2
permalink: 1078-getDossiersForItem
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.getDossiersForItem(objectId);
```

### Parameters

**objectId** _string_

The ID of the object on the Studio or Enterprise Server used to retrieve the IDs of the Dossiers that contain this object.

**Return value** _string[]_

An array of string representing the found Dossier IDs.

## Description

The `getDossierForItem()` method performs a query on the Studio or Enterprise Server to retrieve all Dossier IDs of which the object is part of.

## Examples

**Example title**

```javascript
// prerequisites:
//  - Create, for example, a Layout on the server (e.g. Layout gets ID '41217').
//  - Create multiple Dossiers. (e.g. Dossiers have IDs '41218' and '41219')
//  - Put the Layout in the both Dossiers.

var layoutId = "41217";
var dossierIds = app.getDossiersForItem(layoutId); // [ '41218', '41219' ]
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
