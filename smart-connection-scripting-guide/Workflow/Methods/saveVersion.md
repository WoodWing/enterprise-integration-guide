---
layout: chapter
title: saveVersion
sortid: 105
permalink: 1178-saveVersion
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.saveVersion();
```

### Parameters

**Return value** _Document_

The already opened Document object.

## Description

The `saveVersion()` method silently saves a new version of the document to the Studio Server system. Metadata of the document that has been changed by the calling script will not be picked up and sent to the Studio Server system, instead the existing metadata will be sent.

Throws an exception in case of an error.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
