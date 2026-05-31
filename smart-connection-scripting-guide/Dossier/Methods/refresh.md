---
layout: chapter
title: refresh
sortid: 22
permalink: 1102-refresh
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Dossier.refresh();
```

### Parameters

**Return value**

The `refresh()` method does not return a value.

## Description

The `refresh()` method refreshes the Dossier object by re-fetching its metadata and items from Studio Server.

## Examples

**Refresh a dossier and read its updated name**

```javascript
// Retrieve a dossier, refresh it, then read the current metadata.
var dossier = app.dossiers.retrieve("456");
dossier.refresh();
var name = dossier.entMetaData.get("Core_Name");
alert("Current dossier name: " + name);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
