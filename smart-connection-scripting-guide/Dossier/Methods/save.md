---
layout: chapter
title: save
sortid: 25
permalink: 1105-save
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Dossier.save();
```

### Parameters

**Return value**

The `save()` method does not return a value.

## Description

The `save()` method saves the Dossier object to Studio Server. If the Dossier does not yet exist on Studio Server, it is created first.

## Examples

**Update the name of an existing dossier and save it**

```javascript
// Retrieve a dossier, update its name, then save it.
var dossier = app.dossiers.retrieve("456");
dossier.entMetaData.set("Core_Name", "Updated Dossier Name");
dossier.save();
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
