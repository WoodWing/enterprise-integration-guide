---
layout: chapter
title: openObject
sortid: 6
permalink: 1082-openObject
---
## Syntax

```javascript
app.openObject(objectId [, checkout] [, withWindow] [, type] [, doessierId]);
```

### Parameters

**objectId** *string*

The object ID on the Enterprise Server of the object to open.

**checkout** *boolean (Optional)*

Pass `false` to open te document as read-only. For template files, pass `false` top open an instance instead of the original object.
Default value is `true`.

**withWindow** *boolean (Optional)*

Pass `false` top open the document without opening a window.
Default is `true`.

**type** *string (Optional)*

The object type. Default is an empty string.

**dossierId** *string (Optional)*

The ID of the default parent Dossier. Default is an empty string.
The passed Dossier ID will be used as the default selected Dossier in the Save As dialog ow when creating an Article or Image from the Layout (if the document is a layout).

**Return value** *Document*

The Document object which is opened. Undefined when a Document could not be openend.

## Description

The `openObject()` method opens a Document from the Enterprise Server. Throws an exception in case of an error.

## Examples

**Example title**

```javascript

```

## Support versions

| Adobe Version | Support |
|---------------|---------|
| CC            | ✔       |
| CC 2014       | ✔       |
| CC 2015       | ✔       |
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |