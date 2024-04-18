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

The object ID on the Studio or Enterprise Server of the object to get its Dossiers for.

**Return value** _string[]_

An array of string representing the Browse query result.
The result is comma separated.

## Description

The `getDossierForItem()` method performs a query on the Studio or Enterprise Server to retrieve all Dossier IDs of which the object is part of.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
