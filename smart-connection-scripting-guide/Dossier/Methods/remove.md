---
layout: chapter
title: remove
sortid: 23
permalink: 1103-remove
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Dossier.remove();
```

### Parameters

**Return value**

The `remove()` method does not return a value.

## Description

The `remove()` method deletes the Dossier object. The corresponding Dossier is also removed from Studio Server.

## Examples

**Remove an existing dossier**

```javascript
// Retrieve a dossier and remove it from Studio Server.
var dossier = app.dossiers.retrieve("456");
dossier.remove();
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
