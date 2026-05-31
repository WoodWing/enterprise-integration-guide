---
layout: chapter
title: defaultEditions
sortid: 13
permalink: 1090-defaultEditions
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Document.defaultEditions;
```

### Access

_read/write_

### Parameters

**Return value** _string[]_

An array of Edition names.

## Description

The `defaultEditions` property gets or sets the list of Edition names that new page items will be assigned to on creation. Setting this property changes which editions are pre-selected when a new page item is created in the document.

## Examples

**Get the default editions for new page items**

```javascript
// Get the default editions of the active document.
var editions = app.activeDocument.defaultEditions;
alert("Default editions: " + editions.join(", "));
```

**Set the default editions for new page items**

```javascript
// Assign all new page items to the "North" and "South" editions by default.
app.activeDocument.defaultEditions = ["North", "South"];
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
