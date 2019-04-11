---
layout: chapter
title: saveVersion
sortid: 105
permalink: 1178-saveVersion
---
## Syntax

![](../../images/indesign.png "InDesign") ![](../../images/incopy.png "InCopy") ![](../../images/indesignserver.png "InDesign Server")
```javascript
Workflow.saveVersion();
```

### Parameters

**Return value** *Document*

The already opened Document object.

## Description

The `saveVersion()` method silently saves a new version of the document to the Enterprise system. Metadata of the document that has been changed by the calling script will not be picked up and sent to the Enterprise system, instead the existing metadata will be sent.

Throws an exception in case of an error.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC            | ✔         |
| CC 2014       | ✔         |
| CC 2015       | ✔         |
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |