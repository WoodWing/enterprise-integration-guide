---
layout: chapter
title: updateGeometry
sortid: 14
permalink: 1246-updateGeometry
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})
```javascript
app.updateGeometry();
```

### Parameters

**objectId** *string*

The ID of the layout that contains the new geometry information

**Return value**

The `updateGeometry()` method does not return anything.

## Description

The `updateGeometry()` method updates the geometry of an article in InCopy by reopening the layout. In case of failure it throws an exception. This method can be used in conjunction with the `afterGeometryNotification` scripting event.

## Examples

See scripting event afterGeometryNotification.

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC 2019       | v14.3.1+ ✔       |
| 2020          |  v15.2.1+ ✔      |
| 2021          |  v16.3.1+ ✔       |
| 2022          | ✔         |

## See also

* [Application](./index.md)
