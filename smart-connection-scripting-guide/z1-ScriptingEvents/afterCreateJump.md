---
layout: chapter
title: afterCreateJump
sortid: 114
permalink: 1178-afterCreateJump
---

## When

After creating a Smart Jump article.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %})

## Arguments in

|Key |Description|
|----|-----------|
|sourceDocument |The object id of the layout from where the Smart Jump starts.|
|sourceStory |The story id of the first component of the Smart Jump story.|
|sourceContinuationStory |The story id of the continuation element belonging to the first component of the Smart Jump.|
|[destinationDocument] |The object id of the layout where the Smart Jump lands.|
|[destinationStory] |The story id of the second component of the Smart Jump story.|
|[destinationContinuationStory] |The story id of the continuation element belonging to the second component of the Smart Jump.|

## Arguments out

n/a

## Notes

destinationDocument, destinationStory and destinationContinuationStory are optional when for
example using the “Create Jump From Here” command.

## Examples

**Using afterCreateJump**

```javascript
var msg="Source ID: " + app.scriptArgs.get("sourceDocument") + "\n";
msg+="Source Story: " + app.scriptArgs.get("sourceStory") + "\n";
msg+="Source Continuation: "+app.scriptArgs.get("sourceContinuationStory") + "\n";
if( app.scriptArgs.isDefined( "destinationDocument" ) )
{
    msg+="Destination ID: " + app.scriptArgs.get("destinationDocument") + "\n";
    msg+="Destination Story: " + app.scriptArgs.get("destinationStory") + "\n";
    msg+="Dest. Continuation:"+app.scriptArgs.get("destinationContinuationStory")+"\n";
}
alert( msg );
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