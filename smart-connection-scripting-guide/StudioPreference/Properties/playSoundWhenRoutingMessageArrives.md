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

`true` if a sound is played when a routing message arrives, `false` if no sound is played.

## Description

The `playSoundWhenRoutingMessageArrives` property defines if a sound should play when a user receives a message when a file is routed to that user.

The default value is `false`.

## Examples

**Read the current sound preference**

```javascript
// Read whether sound is enabled for routing messages.
var soundEnabled = app.studioPreferences.playSoundWhenRoutingMessageArrives;
alert("Play sound: " + soundEnabled);
```

**Enable sound on routing message arrival**

```javascript
// Play a sound when a routing message arrives.
app.studioPreferences.playSoundWhenRoutingMessageArrives = true;
```

**Disable sound on routing message arrival**

```javascript
// Do not play a sound when a routing message arrives.
app.studioPreferences.playSoundWhenRoutingMessageArrives = false;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
