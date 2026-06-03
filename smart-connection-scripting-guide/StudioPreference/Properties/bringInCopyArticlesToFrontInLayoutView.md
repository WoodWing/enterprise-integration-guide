---
layout: chapter
title: bringInCopyArticlesToFrontInLayoutView
sortid: 68
permalink: 1162-bringInCopyArticlesToFrontInLayoutView
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

```javascript
StudioPreference.bringInCopyArticlesToFrontInLayoutView;
```

### Access

_read/write_

### Parameters

**Return value** _boolean_

`true` if article components are brought to the front in Layout view when an article is opened in InCopy, `false` if they are not.

## Description

The `bringInCopyArticlesToFrontInLayoutView` property defines if all article components of a story should be brought to the front in Layout view when an article is opened in InCopy. This makes sure that all article components are fully accessible and not obscured by other layout objects.

The default value is `false`.

## Examples

**Read the current preference**

```javascript
// Read whether article components are brought to the front in Layout view.
var pref = app.studioPreferences.bringInCopyArticlesToFrontInLayoutView;
alert("Bring to front: " + pref);
```

**Bring article components to the front in Layout view**

```javascript
// Bring all article components to the front when an article is opened in InCopy.
app.studioPreferences.bringInCopyArticlesToFrontInLayoutView = true;
```

**Do not bring article components to the front**

```javascript
// Leave article components in their current z-order in Layout view.
app.studioPreferences.bringInCopyArticlesToFrontInLayoutView = false;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
