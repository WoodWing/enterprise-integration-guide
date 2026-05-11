---
layout: chapter
title: sendObjectToNext
sortid: 11
permalink: 1085-sendObjectToNext
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.sendObjectToNext(objectId);
```

### Parameters

**objectId** _string_

The ID of the object on Studio Server to send to its next workflow status.

**Return value**

The `sendObjectToNext()` method does not return a value.

## Description

The `sendObjectToNext()` method advances an object to its next workflow status on Studio Server. The method requires an active user session. Throws an exception in case of an error.

## Examples

**Send an object to its next workflow status**

```javascript
// Send the object with ID '6315' to its next workflow status.
app.sendObjectToNext("6315");
```

**Use in a try-catch block to handle errors**

```javascript
// Send the object to its next workflow status and handle any errors.
try {
    app.sendObjectToNext("6315");
} catch (e) {
    alert("Failed to send object to next status: " + e.message);
}
```

**Combine with queryObjects() to advance multiple objects**

```javascript
// Query all objects with a specific status and advance each one.
var criteria = [];
criteria[0] = 'Brand, WW News';
criteria[1] = 'Issue, 1st Issue';
criteria[2] = 'Status, Draft';

var queryResult = app.queryObjects(criteria);

// Parse the object IDs from the query result rows.
var rowMatches = queryResult.match(/<(\d+),/g);
if (rowMatches) {
    for (var i = 0; i < rowMatches.length; i++) {
        var objectId = rowMatches[i].replace(/<|,/g, "");
        try {
            app.sendObjectToNext(objectId);
        } catch (e) {
            alert("Failed to send object " + objectId + " to next: " + e.message);
        }
    }
}
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
