---
layout: chapter
title: beforeSaveLayout
sortid: 139
permalink: 1203-beforeSaveLayout
---

## When

Before sending a layout to the Enterprise system.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

|Key | Description |
|----|-------------|
|Core_ID |The object id of the layout being saved.|
|Core_Name |New name.|
|Core_Publication| New Brand.|
|Core_Issue |New Issue.|
|Core_Section |New Section.|
|Editions |New Edition(s)|
|Core_Basket |New Status|
|RouteTo |New routing|
|Action |The workflow action done by the user.|

## Arguments out

|Key |Description|
|----|-----------|
|errorId |Sets the error id to a non-zero value to abort the save.|
|errorMessage |The message to be shown to the user. Requires the errorId to be set.

## Notes

The script can change the document. Changes will be saved and sent to the server.

## Examples

**Using beforeSaveLayout**

```javascript
var msg = 'ID: ' + app.scriptArgs.get( 'Core_ID' ) + '\n';
msg += 'Name: ' + app.scriptArgs.get( 'Core_Name' ) + '\n';
msg += 'Publication: ' + app.scriptArgs.get( 'Core_Publication' ) + '\n';
msg += 'Issue: ' + app.scriptArgs.get( 'Core_Issue' ) + '\n';
msg += 'Section: ' + app.scriptArgs.get( 'Core_Section' ) + '\n';
msg += 'Editions: ' + app.scriptArgs.get( 'Editions' ) + '\n';
msg += 'Status: ' + app.scriptArgs.get( 'Core_Basket' ) + '\n';
msg += 'RouteTo: ' + app.scriptArgs.get( 'RouteTo' ) + '\n';
alert( msg );
// Preferred way is to set the error id and message
app.scriptArgs.set( 'errorId', '12366' );
app.scriptArgs.set( 'errorMessage', 'Cannot save now.' );
// An exception that is not caught results in an error
throw Error('This is an unexpected error');
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
| 2020          | ✔         |

## See also

* [Scripting Events](./index.md)