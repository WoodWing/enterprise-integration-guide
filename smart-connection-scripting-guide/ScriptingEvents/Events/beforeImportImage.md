---
layout: chapter
title: beforeImportImage
sortid: 62
permalink: 1199-beforeImportImage
---

## When 
Before importing (planned) image type files when synchronizing planned layouts and adverts.

## Where 
InDesign.

## Arguments in 
n/a

## Arguments out 
n/a

## Notes 
This event is not called when importing image type files from Smart Connection panels.

## Examples

**Using beforeImportImage**
```javascript
var msg="ID: " + app.scriptArgs.get( "Core_ID" ) + "\n";
msg+="Name: " + app.scriptArgs.get( "Core_Name" ) + "\n";
msg+="Brand: " + app.scriptArgs.get( "Core_Publication" ) + "\n";
msg+="Issue: " + app.scriptArgs.get( "Core_Issue" ) + "\n";
msg+="Section: " + app.scriptArgs.get( "Core_Section" ) + "\n";
msg+="Editions: " + app.scriptArgs.get( "Editions" ) + "\n";
msg+="Status: " + app.scriptArgs.get( "Core_Basket" ) + "\n";
msg+="RouteTo: " + app.scriptArgs.get( "RouteTo" ) + "\n";
msg+="File type: " + app.scriptArgs.get( "Type" ) + "\n";
msg+="File format: " + app.scriptArgs.get( "Format" ) + "\n";
msg+="Frame ID: " + app.scriptArgs.get( "pageitem" ) + "\n";
alert( msg );
```

## See also
* [Scripting Events](../../ScriptingEvents/index.md)