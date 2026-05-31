---
layout: chapter
title: removeItem
sortid: 24
permalink: 1104-removeItem
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Dossier.removeItem(id);
```

### Parameters

**id** _string_

The object ID on the Studio Server of the object to remove from the Dossier.

**Return value**

The `removeItem()` method does not return a value.

## Description

The `removeItem()` method removes an object from the Dossier. The item is also removed from the corresponding Dossier in Studio Server.

## Examples

**Remove an item from an existing dossier**

```javascript
// Retrieve an existing dossier and remove an item from it.
var dossier = app.dossiers.retrieve("456");
dossier.removeItem("6315");
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
