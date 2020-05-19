---
layout: chapter
title: getDossiersForItem
sortid: 2
permalink: 1078-getDossiersForItem
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
app.getDossiersForItem(objectId);
```

### Parameters

**objectId** *string*

The object ID on the Enterprise or Studio Server of the object to get its Dossiers for.

**Return value** *string[]*

An array of string representing the Browse query result.
The result is comma separated.

## Description

The `getDossierForItem()` method performs a query on the Enterprise or Studio Server to retrieve all Dossier IDs of which the object is part of.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |