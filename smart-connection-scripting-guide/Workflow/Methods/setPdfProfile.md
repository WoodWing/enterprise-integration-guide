---
layout: chapter
title: setPdfProfile
sortid: 107
permalink: 1180-setPdfProfile
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.sendDesignUpdate(pdfProfile);
```

### Parameters

**pdfProfile** _String_

The profile to be set.

**Return value** _boolean_

Returns false when the profile does not exist else sets the profile and returns true.

## Description

The `setPdfProfile()` method sets the profile to use when generating PDF files for the current document.

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
