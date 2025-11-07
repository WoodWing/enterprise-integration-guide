---
layout: chapter
title: browseQuery
sortid: 1
permalink: 1076-browseQuery
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.browseQuery(brand, issue, section, state);
```

### Parameters

**brand** _string_

The name of the Brand to browse for.

**issue** _string_

The name of the Issue to browse for.

**section** _string_

The name of the Section to browse for.

**state** _string_

The name of the State to browse for.

**Return value** _string_

A string representing the Browse query result.
The result is comma separated.

## Description

The `browseQuery()` method generates the result of the Browse query returned by the Studio server.

## Examples

**Get the results for a specific query**

```javascript
// Get browse query results from the server.
var queryResult = app.browseQuery("WW News", "1st Issue", "News", "Ready");

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
//  <1921, AWinttroart1, Article, , , 1st Issue, Ready, 2, ,
//  News, 1, 164, 175, Joe, , , 03/01/2018 14:54, , , 56 KB,
//  03/01/2018 15:05, Joe, , Joe, LWinttroart1, WW News, 1, , , ,
//  0;cdcdcd, , 1, , , 3, , application/incopyicml, false, 1, 1, 2, false>
//
//  <1922, Art2, Article, , , 1st Issue, Ready, 2, , News, 1,
//  523.275591, 769.889764, Joe, , , 03/01/2018 14:59, , , 50 KB,
//  03/01/2018 15:01, Joe, , , LWinttroart1, WW News, 1, , , , 0;cdcdcd,
//   , 1, , , 1, , application/incopyicml, false, 1, 1, 2, false>
//
//
//  First Entry: 1
//
//  Listed Entries: 3
//
//  Total Entries: 3"
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
