---
layout: chapter
title: getIssue
sortid: 84
permalink: 1209-getIssue
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Session.getIssue(issueName, brandName);
```

### Parameters

**issue** *string*

The name of the Issue.

**publication** *string*

The name of the Brand.

**Return value** *[Issue](../../EntIssue/index.md)*

Returns the Issue with the provided name from the provided Brand. Throws an exception if the Issue does not exist.

## Description

The `getIssue()` method returns the Issue with the provided name from the provided Brand.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC            | ✔       |
| CC 2014       | ✔       |
| CC 2015       | ✔       |
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |