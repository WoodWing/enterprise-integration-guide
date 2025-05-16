---
layout: chapter
title: playSoundWhenRoutingMessageArrives
sortid: 68
permalink: 1162-playSoundWhenRoutingMessageArrives
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

```javascript
StudioPreference.playSoundWhenRoutingMessageArrives;
```

### Access

_read/write_

### Parameters

**Return value** _boolean_

## Description

The `playSoundWhenRoutingMessageArrives` property defines if a sound should play when a user receives a message when a file is routed to that user.

The default value is 'false'.

## Examples

**Turn on the "Play Sound when Message Arrives" preference**

```javascript
app.studioPreferences.playSoundWhenRoutingMessageArrives = true;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |

