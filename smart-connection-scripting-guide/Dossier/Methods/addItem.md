---
layout: chapter
title: addItem
sortid: 20
permalink: 1099-addItem
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Dossier.addItem(id);
```

### Parameters

**id** _string_

The object ID on the Studio Server of the object to add to the Dossier.

**Return value**

The `addItem()` method does not return a value.

## Description

The `addItem()` method adds an object to the Dossier. The item is also added to the corresponding Dossier in Studio Server.

## Examples

**Add an item to an existing dossier**

```javascript
// Retrieve an existing dossier and add an item to it.
var dossier = app.dossiers.retrieve("456");
dossier.addItem("6315");
```

**Add multiple items to a dossier**

```javascript
// Retrieve a dossier and add several objects to it.
var dossier = app.dossiers.retrieve("456");
var itemIds = ["6315", "6316", "6317"];
for (var i = 0; i < itemIds.length; i++) {
    dossier.addItem(itemIds[i]);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
