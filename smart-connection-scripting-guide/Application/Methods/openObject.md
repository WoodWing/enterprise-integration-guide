---
layout: chapter
title: openObject
sortid: 6
permalink: 1082-openObject
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.openObject(objectId [, checkout] [, withWindow] [, type] [, dossierId]);
```

### Parameters

**objectId** *string*

The ID of the object to open on Enterprise Server

**checkout** *boolean (Optional)*

Pass `false` to open the document as read-only. For template files, pass `false` to open an instance instead of the original object.
Default value is `true`.

**withWindow** *boolean (Optional)*

Pass `false` to open the document without opening a window.
Default is `true`.

**type** *string (Optional)*

The object type. Default is an empty string.

**dossierId** *string (Optional)*

The ID of the default parent Dossier. Default is an empty string.
The passed Dossier ID will be used as the default selected Dossier in the Save As dialog when creating an Article or Image from the Layout (if the document is a Layout).

**server** *string (Optional)*

The name of the server on which the object with the `objectId` is stored. When needed the user will get the possibility to log in to this server.

**Return value** *Document*  
<sub>(Supported from v12.3, v13.1, v14.1)</sub>

The Document object which is opened. Undefined when a Document could not be openend.

## Description

The `openObject()` method opens a Document from the Enterprise Server. Throws an exception in case of an error.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC            | ✔         |
| CC 2014       | ✔         |
| CC 2015       | ✔         |
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |
