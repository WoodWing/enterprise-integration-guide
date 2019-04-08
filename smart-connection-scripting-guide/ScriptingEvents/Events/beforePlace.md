---
layout: chapter
title: beforePlace
sortid: 62
permalink: 1201-beforePlace
---

## When 
Before placing an object.

## Where 
InDesign, InDesign Server.

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

## See also
* [Scripting Events](../../ScriptingEvents/index.md)