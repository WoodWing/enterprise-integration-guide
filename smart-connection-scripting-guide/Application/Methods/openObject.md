---
layout: chapter
title: openObject
sortid: 7
permalink: 1082-openObject
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.openObject(objectId [, checkout] [, withWindow] [, type] [, dossierId]);
```

### Parameters

**objectId** _string_

The ID of the object to open on Studio or Studio Server

**checkout** _boolean (Optional)_

Pass `false` to open the object as read-only. For template files, pass `false` to open an instance instead of the original object.
Default value is `true`.

**withWindow** _boolean (Optional)_

Pass `false` to open a document without opening a window.
Default is `true`.

**type** _string (Optional)_

The object type. Default is an empty string.

**dossierId** _string (Optional)_

The ID of the default parent Dossier. Default is an empty string.
The passed Dossier ID will be used as the default selected Dossier in the Save As dialog when creating an Article or Image from the Layout, if the opened object is a Layout.

**server** _string (Optional)_
<sub>(Supported from v14.1)</sub>

The name of the server on which the object with the `objectId` is stored. When needed the user will get the possibility to log in to this server.

**Return value** _Object_

The object that is opened. Undefined when an object could not be opened.

## Description

The `openObject()` method opens an object from the Studio Server. Throws an exception in case of an error.

## Examples

**Example title**

```javascript
// Open an object with only the objectId.
// The object will be checked out and opened in a window by default.
var obj = app.openObject("article123");

// Open an object as read-only (not checked out).
var objReadOnly = app.openObject("article123", false);

// Open an object without a window.
var objNoWindow = app.openObject("article123", true, false);

// Open an object with a specific type.
var objWithType = app.openObject("layout567", true, true, "Layout");

// Open a layout and provide a default Dossier ID.
var objWithDossier = app.openObject(
  "layout567",
  true,
  true,
  "Layout",
  "dossier890"
);

// Open an object on a specific server (supported from v14.1).
var objFromServer = app.openObject(
  "image234",
  true,
  true,
  "Image",
  "",
  "RemoteServer01"
);

// Use in a try-catch block to handle errors.
try {
  var obj = app.openObject("article999");
} catch (e) {
  alert("Error opening object: " + e.message + " - " e.number);
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
