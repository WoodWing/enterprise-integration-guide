---
layout: chapter
title: namedQuery
sortid: 5
permalink: 1080-namedQuery
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.namedQuery(queryName);
```

### Parameters

**queryName** _string_

The name of the query (case insensitive).

**Return value** _string_

A string representing the Browse query result.
The result is comma separated.

## Description

The `namedQuery()` function performs a named query. It can be used for the standard Inbox, Libraries and Templates queries.
The `namedQuery()` function can also be use for any other custom created Named Query on the Named Queries page of Studio Server.

## Examples

**Example title**

```javascript
var queryResults = app.namedQuery("inbox"); // or
queryResults = app.namedQuery("lIbraRies"); // or
queryResults = app.namedQuery("templates");

// Example of queryResults:
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
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
