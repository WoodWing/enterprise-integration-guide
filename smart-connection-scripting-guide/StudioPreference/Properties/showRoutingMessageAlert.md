---
layout: chapter
title: showRoutingMessageAlert
sortid: 68
permalink: 1162-showRoutingMessageAlert
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

```javascript
StudioPreference.showRoutingMessageAlert;
```

### Access

_read/write_

### Parameters

**Return value** _ShowRoutingMessageOptions_

An ShowRoutingMessageOptions enum value (see below).

## Description

The `showRoutingMessageAlert` property defines if a message is shown on screen for a user when an object is routed to that user or any user groups of which the user is part.

Use one of the following options:

| Value                                              | Description                                                                                    |
| -------------------------------------------------- | ---------------------------------------------------------------------------------------------- |
| ShowRoutingMessageOptions.DO_NOT_SHOW              | No message is shown.                                                                           |
| ShowRoutingMessageOptions.SHOW_SENT_TO_ME          | A message is shown when an object is routed to the user only.                                  |
| ShowRoutingMessageOptions.SHOW_SENT_TO_ME_OR_GROUP | A message is shown when an object is routed to the user or any of the groups the user is part. |

The default value is ShowRoutingMessageOptions.DO_NOT_SHOW.

## Examples

**Set the "Routing Message Options > Alert" preference to "Do not show dialog"**

```javascript
app.studioPreferences.showRoutingMessageAlert =
  ShowRoutingMessageOptions.DO_NOT_SHOW;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2020          | v15.2+ ✔  |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
