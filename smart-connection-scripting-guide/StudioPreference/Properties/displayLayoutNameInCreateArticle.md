---
layout: chapter
title: displayLayoutNameInCreateArticle
sortid: 68
permalink: 1162-displayLayoutNameInCreateArticle
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
StudioPreference.displayLayoutNameInCreateArticle;
```

### Access

_read/write_

### Parameters

**Return value** _boolean_

`true` if the layout name is used as the default article name, `false` if it is not.

## Description

The `displayLayoutNameInCreateArticle` property defines if the name of the layout should be used as the default name for an article that is created from a frame on the layout.

The default value is `false`.

## Examples

**Read the current preference**

```javascript
// Read whether the layout name is used as the default article name.
var pref = app.studioPreferences.displayLayoutNameInCreateArticle;
alert("Display layout name: " + pref);
```

**Use the layout name as the default article name**

```javascript
// Pre-fill the article name with the layout name when creating an article.
app.studioPreferences.displayLayoutNameInCreateArticle = true;
```

**Do not use the layout name as the default article name**

```javascript
// Leave the article name field empty when creating an article.
app.studioPreferences.displayLayoutNameInCreateArticle = false;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
