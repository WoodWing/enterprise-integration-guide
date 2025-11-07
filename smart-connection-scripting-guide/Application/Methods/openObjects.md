---
layout: chapter
title: openObjects
sortid: 8
permalink: 1082-openObjects
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

```javascript
app.openObjects(server, ids [, readonly] [, instantiate] [, dossier]);
```

### Parameters

**server** _string_

The name of Studio Server (as defined in the WWSettings.xml file) from which the files should be opened.

**objectId** _string[]_

The IDs of the files that should be opened.

**readonly** _boolean (Optional)_

Defines if the file should be opened as read-only.

Default value: `false`.

Notes:

- Has to be set to true when a layout is opened in InCopy.

- Layout templates and Layout Module templates cannot be opened as read-only.

**instantiate** _boolean (Optional)_

Defines if a new document should be instantiated from a template. The referenced file should therefore be a template; the parameter is ignored when the file is a regular layout or article.

Default value: `true`.

**dossier** _string (Optional)_

The ID of the default parent Dossier. Only used when instantiating Layout templates or Layout Module templates.

Default value: an empty string.

**Return value**

The `openObjects()` method does not return anything.

## Description

The `openObject()` method opens files from the Studio Server. It will give the user the possibility to log in when that is not yet the case. It does not throw errors for non existing objects. Not supported for InDesign Server.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
