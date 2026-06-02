---
layout: chapter
title: getTerm
sortid: 89
permalink: 1214-getTerm
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```text
Session.getTerm(term);
```

### Parameters

**term** _string_

The system term to look up.

**Return value** _string_

The display value of the provided system term as configured on Studio Server.

## Description

The `getTerm()` method returns the display value of several terms used in the system. Can be used for creating custom UI. For further information on changing terminology including a list of supported terms, see the Admin Guide.

## Examples

**Get the display name for a system term**

```javascript
// Get the display value of the "Brand" term as configured on Studio Server.
var term = app.entSession.getTerm("Brand");
alert("Brand is called: " + term);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
