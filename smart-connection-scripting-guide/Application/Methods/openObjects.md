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
// Open multiple objects by passing their IDs as an array.
// Objects are checked out by default.
app.openObjects("StudioServer01", ["article123", "article456"]);

// Open multiple objects as read-only (not checked out).
// Required when opening layouts in InCopy.
app.openObjects("StudioServer01", ["layout123", "layout456"], true);

// Open template files as new instances (default behavior).
app.openObjects("StudioServer01", ["template123", "template456"]);

// Open template files as originals, not as new instances.
app.openObjects("StudioServer01", ["template123", "template456"], false, false);

// Open layout templates and specify a default parent Dossier.
// The Dossier ID is used as the default in the Save As dialog when instantiating
// Layout or Layout Module templates.
app.openObjects(
  "StudioServer01",
  ["template123", "template456"],
  false,
  true,
  "dossier890"
);

// Build an array of IDs dynamically and open them all at once.
// Non-existing IDs are silently ignored — no error is thrown.
var ids = ["article123", "article456", "layout789"];
app.openObjects("StudioServer01", ids);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
