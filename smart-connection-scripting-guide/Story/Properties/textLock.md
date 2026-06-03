---
layout: chapter
title: textLock
sortid: 100
permalink: 1272-textLock
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
Story.textLock;
```

### Access

_read/write_

### Parameters

**Return value** _boolean_

`true` if the story text is locked, `false` if it is unlocked.

## Description

The `textLock` property controls whether the text in this story is locked. When `true`, the story text cannot be edited. When `false`, the story text is unlocked and editable.

## Examples

**Read the lock state of a story**

```javascript
// Check whether the first story in the active document is locked.
var story = app.activeDocument.stories[0];
var isLocked = story.textLock;
alert("Story locked: " + isLocked);
```

**Lock a story**

```javascript
// Lock the text of the first story in the active document.
app.activeDocument.stories[0].textLock = true;
```

**Unlock a story**

```javascript
// Unlock the text of the first story in the active document.
app.activeDocument.stories[0].textLock = false;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
