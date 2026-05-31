---
layout: chapter
title: activeEdition
sortid: 12
permalink: 1089-activeEdition
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Document.activeEdition;
```

### Access

_read/write_

### Parameters

**Return value** _string_

The name of the active Edition.

## Description

The `activeEdition` property gets or sets the active Edition of the Document. The active Edition controls which edition-specific content is visible in the layout. The available editions are defined in the document's metadata.

## Examples

**Get the active edition of the document**

```javascript
// Get the active edition of the active document.
var edition = app.activeDocument.activeEdition;
alert("Active edition: " + edition);
```

**Set the active edition of the document**

```javascript
// Set the active edition to show the "North" edition content.
app.activeDocument.activeEdition = "North";
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
