---
layout: chapter
title: overrideFrameElementLabelOnPlace
sortid: 68
permalink: 1162-overrideFrameElementLabelOnPlace
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
StudioPreference.overrideFrameElementLabelOnPlace;
```

### Access

_read/write_

### Parameters

**Return value** _boolean_

`true` if the Element Label of the target frame is overridden with the Element Label of the placed article component when content is placed, `false` if the frame's current Element Label is preserved.

## Description

The `overrideFrameElementLabelOnPlace` property defines whether the Element Label of a target frame should be replaced with the Element Label of the placed article component when that component is placed into the frame. When enabled, placing a component into a frame updates the frame's Element Label to match the component's Element Label, but only when the component carries a non-empty Element Label that differs from the frame's current Element Label. When disabled, the frame's existing Element Label is left unchanged when content is placed into it.

This preference corresponds to the "Override frame Element Label with placed article component Element Label" option in the Element Tags configuration dialog.

The default value is `true`.

## Examples

**Read the current preference**

```javascript
// Read whether the frame Element Label is overridden on place.
var pref = app.studioPreferences.overrideFrameElementLabelOnPlace;
alert("Override frame element label on place: " + pref);
```

**Override the frame Element Label with the placed component's Element Label**

```javascript
// Update the frame's Element Label to match the placed component's Element Label.
app.studioPreferences.overrideFrameElementLabelOnPlace = true;
```

**Keep the frame's existing Element Label when placing content**

```javascript
// Preserve the frame's own Element Label when a component is placed into it.
app.studioPreferences.overrideFrameElementLabelOnPlace = false;
```

**Place an object without overriding the frame's Element Label, then restore the original preference**

```javascript
// Temporarily disable the override so the frame keeps its own Element Label for this placement.
var originalPref = app.studioPreferences.overrideFrameElementLabelOnPlace;
app.studioPreferences.overrideFrameElementLabelOnPlace = false;

// Place the object; the frame's own Element Label is preserved during this placement.
app.selection[0].placeObject("6315");

// Restore the preference to its original value.
app.studioPreferences.overrideFrameElementLabelOnPlace = originalPref;
```

## Supported versions

| Adobe Version  | Supported |
| -------------- | --------- |
| 2023           |           |
| 2024           |           |
| 2025 (v20.0.5) | ✔         |
| 2026 (v21.0.2) | ✔         |

## See also

- [elementLabel](../../PageItem/Properties/elementLabel.md)
