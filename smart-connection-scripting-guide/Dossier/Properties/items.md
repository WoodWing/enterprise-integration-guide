---
layout: chapter
title: items
sortid: 28
permalink: 1108-items
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Dossier.items;
```

### Access

_readonly_

### Parameters

**Return value** _string[]_

An array of Studio Server object IDs of the items in the Dossier.

## Description

The `items` property returns an array of object ID strings representing all Studio Server objects that belong to the Dossier.

## Examples

**List all item IDs in a dossier**

```javascript
// Retrieve a dossier and list all its item IDs.
var dossier = app.dossiers.retrieve("456");
var items = dossier.items;
for (var i = 0; i < items.length; i++) {
    alert("Item ID: " + items[i]);
}
```

**Check whether a specific item is in the dossier**

```javascript
// Check if object with ID "6315" is in the dossier.
var dossier = app.dossiers.retrieve("456");
var items = dossier.items;
var found = false;
for (var i = 0; i < items.length; i++) {
    if (items[i] === "6315") {
        found = true;
        break;
    }
}
alert(found ? "Item found in dossier." : "Item not in dossier.");
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
