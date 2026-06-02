---
layout: chapter
title: entMetaData
sortid: 47
permalink: 1127-entMetaData
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
ManagedAdvert.entMetaData;
```

### Access

_readonly_

### Parameters

**Return value** _[EntMetaData](../../EntMetaData/index.md)_

The Studio Server metadata object associated with the ManagedAdvert.

## Description

The `entMetaData` property returns an [EntMetaData](../../EntMetaData/index.md) object that provides access to the Studio Server metadata associated with the ManagedAdvert. Use this object to read metadata values such as the object ID, name, and status.

## Examples

**Read the name of the first managed advert**

```javascript
// Get the metadata of the first managed advert in the active document.
var adverts = app.activeDocument.managedAdverts;
if (adverts.count() > 0) {
    var advert = adverts[0];
    var name = advert.entMetaData.get("Core_Name");
    alert("Advert name: " + name);
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
