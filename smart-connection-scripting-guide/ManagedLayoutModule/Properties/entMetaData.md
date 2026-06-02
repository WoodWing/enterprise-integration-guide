---
layout: chapter
title: entMetaData
sortid: 68
permalink: 1162-entMetaData
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedLayoutModule.entMetaData;
```

### Access

_readonly_

### Parameters

**Return value** _[EntMetaData](../../EntMetaData/index.md)_

The Studio Server metadata object associated with the ManagedLayoutModule.

## Description

The `entMetaData` property returns an [EntMetaData](../../EntMetaData/index.md) object that provides access to the Studio Server metadata associated with the ManagedLayoutModule. Use this object to read metadata values such as the layout module name, brand, and status.

## Examples

**Read the name of the first managed layout module**

```javascript
// Get the metadata of the first managed layout module in the active document.
var modules = app.activeDocument.managedLayoutModules;
if (modules.count() > 0) {
    var module = modules[0];
    var name = module.entMetaData.get("Core_Name");
    alert("Layout module name: " + name);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [EntMetaData](../../EntMetaData/index.md)
