---
layout: chapter
title: restoreFromArchive
sortid: 103
permalink: 1176-restoreFromArchive
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
Workflow.restoreFromArchive([pathInElvis] [, imageRestoreLocation]);
```

### Parameters

**pathInElvis** *String (Optional)*

The path in Elvis where the images should be copied to. Might be empty. In that case the images are not restored and will be unlinked.

Only used in combination with the “Elvis_Copy” image restore location (defined in the script or in the Elvis Enterprise Server plug-in). For the other image restore locations this parameter can be empty.

**imageRestoreLocation** *String (Optional)*

Defines the restore location of images. When not de ned the option as de ned in the Elvis Enterprise Server plug-in is used. Possible values:

| Value      | Description                                                                |
|------------|----------------------------------------------------------------------------|
| Elvis_Copy | The image is copied in Elvis and is linked via an Enterprise shadow object |
| Enterprise | The image is copied to Enterprise                                          |

**Return value** *Document*

The restored Document object.

## Description

The `restoreFromArchive()` method restores the opened archived document from Elvis as a new object in the Enterprise system. Throws an exception in case of an error. Change the metadata before calling `restoreFromArchive()`.

Articles on the document will be copied to Enterprise and the Article Components will get new IDs. Spreadsheets are copied to Enterprise.

## Examples

**Example title**

```javascript

```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC            |           |
| CC 2014       | ✔ (v10.1) |
| CC 2015       | ✔         |
| CC 2017       | ✔         |
| CC 2018       | ✔         |
| CC 2019       | ✔         |