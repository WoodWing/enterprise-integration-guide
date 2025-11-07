---
layout: chapter
title: afterCreateContinuationElement
sortid: 112
permalink: 1176-afterCreateContinuationElement
---

## When

After creating a continuation element for a Smart Jump article.

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %})

## Arguments in

| Key                     | Description                                                                                       |
| ----------------------- | ------------------------------------------------------------------------------------------------- |
| document                | The object id of the layout from where the element is created on.                                 |
| parentStory             | The story id of the component of the Smart Jump story the element belongs to.                     |
| [continuationFromStory] | The story id of the continuation from element belonging to the component of the Smart Jump story. |
| [continuationOnStory]   | The story id of the continuation on element belonging to the component of the Smart Jump story.   |

## Arguments out

n/a

## Notes

The event is not sent when creating a Smart Jump. In that case the afterCreateJump event is sent.

## Examples

**Using afterCreateJump**

```javascript
var msg = "Document: " + app.scriptArgs.get("document") + "\n";
msg += "Parent Story: " + app.scriptArgs.get("parentStory") + "\n";
if (app.scriptArgs.isDefined("continuationToStory"))
  msg +=
    "Continuation To Story: " +
    app.scriptArgs.get("continuationToStory") +
    "\n";
if (app.scriptArgs.isDefined("continuationFromStory"))
  msg +=
    "Continuation From Story: " +
    app.scriptArgs.get("continuationFromStory") +
    "\n";
alert(msg);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |

## See also

- [Scripting Events](./index.md)
