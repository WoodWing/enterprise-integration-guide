---
layout: chapter
title: defaultDossier
sortid: 109
permalink: 1182-defaultDossier
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.defaultDossier;
```

### Access

_read/write_

### Parameters

**Return value** _string_

The ID of the dossier used as the default in the create workflow dialog.

## Description

The `defaultDossier` property gets or sets the ID of the Dossier that is pre-selected as the default in the create workflow dialog.

## Examples

**Read the default dossier ID**

```javascript
// Get the ID of the default dossier for the active document.
var dossierId = app.activeDocument.entWorkflow.defaultDossier;
alert("Default dossier ID: " + dossierId);
```

**Set the default dossier**

```javascript
// Pre-select a specific dossier in the create workflow dialog.
app.activeDocument.entWorkflow.defaultDossier = "98765";
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
