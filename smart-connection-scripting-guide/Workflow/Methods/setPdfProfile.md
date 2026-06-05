---
layout: chapter
title: setPdfProfile
sortid: 107
permalink: 1180-setPdfProfile
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.setPdfProfile([pdfProfile]);
```

### Parameters

**pdfProfile** _String (Optional)_

The name of the PDF export profile to use during check-in or save. When omitted, any previously set profile is cleared.

**Return value** _boolean_

Returns `true` if the profile was found and set, or `false` if the profile does not exist. When called without a parameter, clears the profile and returns `false`.

## Description

The `setPdfProfile()` method sets the PDF export profile to use when generating PDF files during check-in or save. It is typically called from a `beforeCheckIn` or `beforeSave` event handler script to specify which PDF profile should be applied.

If the provided profile name does not exist in InDesign's list of PDF export styles, the method returns `false` and no profile is applied.

## Examples

**Set a PDF profile to use during check-in**

```javascript
// Set the PDF profile to be applied during the next check-in or save.
var success = app.activeDocument.entWorkflow.setPdfProfile("PDF/X-4");
if (success) {
  alert("PDF profile set to PDF/X-4.");
} else {
  alert("PDF profile 'PDF/X-4' was not found.");
}
```

**Clear the PDF profile**

```javascript
// Clear the PDF profile so that no profile is applied during check-in or save.
app.activeDocument.entWorkflow.setPdfProfile();
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
