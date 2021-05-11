---
layout: chapter
title: beforePlace
sortid: 138
permalink: 1201-beforePlace
---

## When

Before placing an object.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

## Arguments in

|Key |Description|
|----|-----------|
|Core_ID |The object ID instigated to be placed.|
|GUID |The GUID of the component to be placed.|

## Arguments out

|Key |Description|
|----|-----------|
|objectId |The overruling object ID when the incoming object must be overruled. Empty when no change has to be made.|
|GUID |The overruling GUID when the incoming GUID must be overruled. Empty when no change has to be made.|

## Notes

The script argument key ‘objectId’ is mandatory and case sensitive when sending back an object ID.

## Example Script

```javascript
var objId = app.scriptArgs.get("Core_ID");
var compGUID = app.scriptArgs.get("GUID");
 
// Define the return variable (default empty string).
var overrulingObjId = "";
var overrulingGUID = "";
 
// If the sent object ID is '11801 indicate that object with ID '9668' should be placed.
if(objId === "11801") {
    overrulingObjId = "9668"
}
 
// Correct GUID if necessary.
if(compGUID === "9460ad9f-7e87-4dea-9a25-491a0d43e297") {
    overrulingGUID = "6f717dfc-6c71-4072-a219-519ac94e2c0a";
}
 
// The script argument key 'objectId' is mandatory and case sensative when sending back an object ID.
app.scriptArgs.set("objectId", overrulingObjId);
app.scriptArgs.set("GUID", overrulingGUID);
```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2018       | ✔         |
| CC 2019       | ✔         |
| 2020          | ✔         |
| 2021          | ✔         |

## See also

* [Scripting Events](./index.md)