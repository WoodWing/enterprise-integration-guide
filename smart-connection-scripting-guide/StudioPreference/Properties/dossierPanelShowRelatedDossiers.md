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

`true` if related dossiers are shown in the Dossier panel, `false` if they are hidden.

## Description

The `dossierPanelShowRelatedDossiers` property defines whether related dossiers should be displayed in the Dossier panel. When enabled, the Dossier panel shows all dossiers that the placed files in the layout are part of. When disabled, only the dossier of the checked-out layout is shown.

The default value is `true`.

## Examples

**Read the current preference**

```javascript
// Read whether related dossiers are shown in the Dossier panel.
var pref = app.studioPreferences.dossierPanelShowRelatedDossiers;
alert("Show related dossiers: " + pref);
```

**Show related dossiers in the Dossier panel**

```javascript
// Show all dossiers that placed files in the layout are part of.
app.studioPreferences.dossierPanelShowRelatedDossiers = true;
```

**Hide related dossiers — show only the layout's own dossier**

```javascript
// Show only the dossier of the checked-out layout. Dossiers containing placed files are hidden.
app.studioPreferences.dossierPanelShowRelatedDossiers = false;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
