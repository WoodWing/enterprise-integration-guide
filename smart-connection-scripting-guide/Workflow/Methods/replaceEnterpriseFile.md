---
layout: chapter
title: replaceEnterpriseFile
sortid: 106
permalink: 1273-replaceEnterpriseFile
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.replaceEnterpriseFile(id);
```

### Parameters

**id** _string_

The object ID of the Studio Server layout whose file should be replaced.

**Return value**

The `replaceEnterpriseFile()` method does not return a value.

## Description

The `replaceEnterpriseFile()` method replaces the cached file of the Studio Server layout identified by `id` with the file of the current active document. The current document is saved to the location used by the Studio Server plug-in's local file cache, effectively replacing the cached copy of the target object.

The user must be logged in to Studio Server before calling this method. Throws an exception in case of an error.

## Examples

**Replace the cached file of a Studio Server layout**

```javascript
// Replace the Enterprise file of object "1234" with the current document's file.
try {
  app.activeDocument.entWorkflow.replaceEnterpriseFile("1234");
  alert("Enterprise file replaced successfully.");
} catch (e) {
  alert("Replace failed: " + e.message);
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

- [entWorkflow](../../Document/Properties/entWorkflow.md)
