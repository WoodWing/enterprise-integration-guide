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

The ID of the object to open on Studio or Enterprise Server

**checkout** _boolean (Optional)_

Pass `false` to open the document as read-only. For template files, pass `false` to open an instance instead of the original object.
Default value is `true`.

**withWindow** _boolean (Optional)_

Pass `false` to open the document without opening a window.
Default is `true`.

**type** _string (Optional)_

The object type. Default is an empty string.

**dossierId** _string (Optional)_

The ID of the default parent Dossier. Default is an empty string.
The passed Dossier ID will be used as the default selected Dossier in the Save As dialog when creating an Article or Image from the Layout (if the document is a Layout).

**server** _string (Optional)_
<sub>(Supported from v14.1)</sub>

The name of the server on which the object with the `objectId` is stored. When needed the user will get the possibility to log in to this server.

**Return value** _Document_

The Document object which is opened. Undefined when a Document could not be opened.

## Description

The `openObject()` method opens a Document from the Studio or Enterprise Server. Throws an exception in case of an error.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
