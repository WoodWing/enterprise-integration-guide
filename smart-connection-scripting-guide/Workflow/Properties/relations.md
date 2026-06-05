---
layout: chapter
title: relations
sortid: 110
permalink: 1274-relations
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Workflow.relations;
```

### Access

_readonly_

### Parameters

**Return value** _string_

An XML string containing all database relations of the current document. Returns an empty string if the document has no relations or the required plug-in is not installed.

## Description

The `relations` property returns an XML string describing all database relations of the active document as stored in Studio Server. This includes relations to articles, images, and other placed content.

## Examples

**Get the database relations of the active document**

```javascript
// Retrieve the database relations of the active document as XML.
var relationsXml = app.activeDocument.entWorkflow.relations;
$.writeln(relationsXml);
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
