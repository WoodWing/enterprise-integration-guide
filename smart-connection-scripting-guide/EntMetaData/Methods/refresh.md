---
layout: chapter
title: refresh
sortid: 39
permalink: 1227-refresh
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
EntMetaData.refresh();
```

### Parameters

**Return value**

The `refresh()` method does not return a value.

## Description

The `refresh()` method refreshes the metadata in this scripting object with the metadata stored in the document. The refresh does not interact with the Studio Server system to retrieve the latest data, but relies on the data delivered to the application through the messaging subsystem.

## Examples

**Refresh metadata and read the updated name**

```javascript
// Refresh the metadata of the active document, then read the current name.
var md = app.activeDocument.entMetaData;
md.refresh();
var name = md.get("Core_Name");
alert("Refreshed document name: " + name);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
