---
layout: chapter
title: refresh
sortid: 39
permalink: 1227-refresh
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
EntMetaData.refresh();
```

### Parameters

**Return value**

The `refresh()` method does not return anything.

## Description

The `refresh()` method refreshes the metadata in this scripting object with the metadata stored in the document. The refresh does not interact with the Enterprise system to retrieve the latest data, but relies on the data delivered to the application through the messaging
subsystem.

## Examples

**Example title**

```javascript
```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |
| 2020          | ✔       |