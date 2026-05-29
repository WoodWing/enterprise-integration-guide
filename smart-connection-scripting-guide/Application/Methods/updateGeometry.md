---
layout: chapter
title: updateGeometry
sortid: 14
permalink: 1246-updateGeometry
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

```javascript
app.updateGeometry(layoutId);
```

### Parameters

**layoutId** _string_

The ID of the layout that contains the updated geometry information.

**Return value**

The `updateGeometry()` method does not return a value.

## Description

The `updateGeometry()` method applies a pending geometry update to an open InCopy document. It locates the open document that matches the given layout `id` and applies the geometry update if one is available. In case of failure it throws an exception. This method is typically used inside the `afterGeometryNotification` scripting event handler.

## Examples

**Apply a geometry update when notified**

```javascript
// Apply the geometry update for the layout that triggered the notification.
var layoutId = "12345";
app.updateGeometry(layoutId);
```

**Use in a try-catch block to handle errors**

```javascript
// Apply the geometry update and handle any errors.
var layoutId = "12345";
try {
  app.updateGeometry(layoutId);
} catch (e) {
  alert("Failed to update geometry: " + e.message);
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

- [afterGeometryNotification](../../z1-ScriptingEvents/afterGeometryNotification.md)
