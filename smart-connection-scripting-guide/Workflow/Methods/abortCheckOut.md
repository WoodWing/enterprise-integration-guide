---
layout: chapter
title: abortCheckOut
sortid: 100
permalink: 1172-abortCheckOut
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.abortCheckOut();
```

### Parameters

**Return value**

The `abortCheckOut()` method does not return a value.

## Description

The `abortCheckOut()` method cancels the check out of the active document and reverts it to the last saved version on Studio Server. Throws an exception in case of an error.

## Examples

**Abort the check out of the active document**

```javascript
// Abort the check out of the active document.
try {
  app.activeDocument.entWorkflow.abortCheckOut();
  alert("Check out aborted successfully.");
} catch (e) {
  alert("Failed to abort check out: " + e.message);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
