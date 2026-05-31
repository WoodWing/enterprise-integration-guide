---
layout: chapter
title: entWorkflow
sortid: 15
permalink: 1092-entWorkflow
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Document.entWorkflow;
```

### Access

_readonly_

### Parameters

**Return value** _[Workflow](../../Workflow/index.md)_

The Studio Server Workflow object for the Document.

## Description

The `entWorkflow` property returns a [Workflow](../../Workflow/index.md) object that provides access to the Studio Server workflow actions for the Document, such as checking in, saving a version, and saving as.

## Examples

**Check in the active document to Studio Server**

```javascript
// Check in the active document.
app.activeDocument.entWorkflow.checkIn();
```

**Save a version of the active document**

```javascript
// Save a version of the active document on Studio Server.
app.activeDocument.entWorkflow.saveVersion();
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [Workflow](../../Workflow/index.md)
