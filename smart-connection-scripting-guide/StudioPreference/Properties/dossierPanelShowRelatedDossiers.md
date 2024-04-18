---
layout: chapter
title: dossierPanelShowRelatedDossiers
sortid: 68
permalink: 1162-dossierPanelShowRelatedDossiers
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
StudioPreference.dossierPanelShowRelatedDossiers;
```

### Access

_read/write_

### Parameters

**Return value** _boolean_

## Description

The `dossierPanelShowRelatedDossiers` property defines whether related dossiers of the active layout should be displayed in the Dossier panel.

The default value is 'true'.

## Examples

**Show only the dossier of the layout that was checked out. Dossiers that contain placed files are hidden.**

```javascript
app.studioPreferences.dossierPanelShowRelatedDossiers = false;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2021          | 16.3.3+ ✔ |
| 2022          | 17.0.1+ ✔ |
| 2023          | ✔         |
| 2024          | ✔         |
