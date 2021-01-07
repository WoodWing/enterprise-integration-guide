---
layout: chapter
title: item
sortid: 38
permalink: 1226-item
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
EntMetaData.item(index);
```

### Parameters

**index** *number or string* 

The index (number) or name (string)

**Return value** *string, string[], number, number[], boolean or boolean[]*

The property value for the given index or key name. If the key does not exist, an error will be thrown.

## Description

The `item()` method returns the property value for the given index or key name. 

## Examples

**Example title**

```javascript
```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC 2018       | ✔       |
| CC 2019       | ✔       |
| 2020          | ✔       |
| 2021          | ✔       |