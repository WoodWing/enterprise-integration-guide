---
layout: chapter
title: queryObjects
sortid: 10
permalink: 1084-queryObjects
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.queryObjects(criteria);
```

### Parameters

**criteria** _string[]_

An array of query criteria strings. Each string is a `key, value` pair where the key is one of the supported criteria names listed below and the value is the search value to match against.

```javascript
criteria[0] = 'Brand, WW News';
criteria[1] = 'Issue, 1st Issue';
criteria[2] = 'Status, Ready';
```

The following criteria keys are supported:

| Key | Description |
| --- | ----------- |
| `Brand` | The name of the Brand (Publication) to filter on. Multiple values can be provided as a comma-separated list. |
| `Issue` | The name of the Issue to filter on. Multiple values can be provided as a comma-separated list. |
| `Edition` | The name of the Edition to filter on. Multiple values can be provided as a comma-separated list. |
| `Category` | The name of the Category (Section) to filter on. Multiple values can be provided as a comma-separated list. |
| `Status` | The name of the workflow Status to filter on. Multiple values can be provided as a comma-separated list. |
| `ID` | The ID of the object to search for. |
| `Name` | The name of the object to search for. |
| `Type` | The type of the object to search for, for example `Article`, `Layout`, or `Image`. |

**Return value** _string_

A string representing the query result. The result contains:

- **Columns**: A list of column definitions, each in the form `<type, name>`.
- **Rows**: One entry per matching object, containing the values for each column separated by commas and enclosed in angle brackets.
- **First Entry**: The index (1-based) of the first entry in the returned result set.
- **Listed Entries**: The number of objects returned in this result.
- **Total Entries**: The total number of objects matching the query.

## Description

The `queryObjects()` method performs a user query on the Studio server based on the provided criteria and returns the matching objects with their properties.

All criteria are combined as AND conditions. Criteria that are not provided are not applied as filters. The `Brand`, `Issue`, `Edition`, `Category`, and `Status` criteria each accept multiple comma-separated values which are treated as OR conditions within that criterion.

## Examples

**Query objects by Brand and Issue**

```javascript
// Build the criteria array.
var criteria = [];
criteria[0] = 'Brand, WW News';
criteria[1] = 'Issue, 1st Issue';
criteria[2] = 'Status, Ready';

// Perform the query.
var queryResult = app.queryObjects(criteria);

// queryResult is now:
//
// "Columns: <int, ID><string, Name><string, Type><string, In Use By>
//    <int, Rating><multilist, Issues><list, Status><string, Status ID>
//    <int, Flag><list, Category><string, Category><double, Width>
//    <double, Height><string, Created By><string, Aspect ratio>
//    <string, Urgency><datetime, Created On><multiline, Description>
//    <string, Copyright (c)><int, Size><datetime, Modified On>
//    <string, Modified By><string, Author><list, Route To>
//    <string, Placed On><list, Brand><string, Brand ID>
//    <string, Planned Page Range><string, Page Range><string, FlagMsg>
//    <icon, Deadline><datetime, Deadline><string, Placed On Page>
//    <multiline, Comment><string, Color Space><int, Columns>
//    <string, Issue ID><string, Format><bool, LockForOffline>
//    <multilist, Issue IDs><multilist, Edition IDs><bool, HasChildren>
//
// Rows:
//  <6315, test-layout, Article, , , 1st Issue, Ready, 2, ,
//  News, 1, 523.275591, 769.889764, Joe, , , 06/12/2018 09:07, , ,
//  56 KB, 06/12/2018 09:10, Joe, , , L-testupdate1, WW News, 1, , , ,
//  0;cdcdcd, , 1, , , 1, , application/incopyicml, false, 1, 1, 2, false>
//
//
//  First Entry: 1
//
//  Listed Entries: 1
//
//  Total Entries: 1"
```

**Query objects by Type and Name**

```javascript
// Search for a layout object by name.
var criteria = [];
criteria[0] = 'Type, Layout';
criteria[1] = 'Name, Front Page';

var queryResult = app.queryObjects(criteria);
```

**Query objects by ID**

```javascript
// Look up a specific object by its ID.
var criteria = [];
criteria[0] = 'ID, 6315';

var queryResult = app.queryObjects(criteria);
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
