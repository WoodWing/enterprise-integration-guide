---
layout: chapter
title: storedUserQuery
sortid: 13
permalink: 1086-storedUserQuery
---

## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})

```javascript
app.storedUserQuery(queryName);
```

### Parameters

**queryName** _string_

The name of the stored user query to execute.

**Return value** _string_

A comma-separated string representing the query result, in the same format as [`browseQuery()`](1076-browseQuery) and [`namedQuery()`](1080-namedQuery): a `Columns:` header section followed by `Rows:` data, and `First Entry:`, `Listed Entries:`, and `Total Entries:` counters.

## Description

The `storedUserQuery()` method executes a query that a user has personally saved through the Studio panel search interface. The stored query definition, including any Brand, Issue, Edition, Section, State, and other search criteria, is retrieved from the local client by name and sent to the Studio server for execution.

The user must be logged in to Studio. If no session exists, the call returns an error. If the given `queryName` does not match any saved query for the current user, the call fails silently (returns an empty result).

### Comparison with related query methods

| Method                                                          | Query definition                                                                                 | Filters                                                                                                      |
| --------------------------------------------------------------- | ------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------ |
| `storedUserQuery(queryName)`                                    | Saved by the **user** through the Smart Connection panel UI (client-side, per user)              | Brand, Issue, Edition, Section, State, plus any additional search criteria saved with the query              |
| [`namedQuery(queryName)`](1080-namedQuery)                      | Defined by an **administrator** on the Named Queries page of Studio Server (server-side, shared) | Fixed criteria as configured on the server; includes built-ins such as `inbox`, `libraries`, and `templates` |
| [`browseQuery(brand, issue, section, state)`](1076-browseQuery) | No stored definition — all filters are passed **inline** as parameters                           | Brand, Issue, Section, and State only                                                                        |

Use `storedUserQuery()` when a script needs to re-execute a query that a user has already configured and saved in their Smart Connection panel, without hardcoding filter values in the script itself. Use `namedQuery()` for shared, server-managed queries. Use `browseQuery()` when you want to pass filter criteria directly from the script.

## Examples

**Execute a saved user query by name**

```javascript
// Execute the stored user query named "My Articles".
// The query and all its saved filters are looked up on the client
// and sent to the Studio server for execution.
var queryResult = app.storedUserQuery("My Articles");
```

**Parse the result of a stored user query**

```javascript
// Execute a stored query and extract the object IDs from the result rows.
var queryResult = app.storedUserQuery("Pending for Review");

// The result uses the same format as browseQuery() and namedQuery().
// Each row is enclosed in angle brackets; the first field is the object ID.
var rows = queryResult.match(/<([^>]+)>/g) || [];
var objectIds = [];
for (var i = 0; i < rows.length; i++) {
  var fields = rows[i].replace(/^<|>$/g, "").split(", ");
  var id = parseInt(fields[0], 10);
  if (!isNaN(id)) {
    objectIds.push(id);
  }
}
// objectIds now contains all Studio object IDs returned by the query.
```

**Choose between storedUserQuery, namedQuery, and browseQuery**

```javascript
// Use storedUserQuery() to re-run a query the user saved in the panel,
// without hardcoding its filter values in the script.
var savedResult = app.storedUserQuery("Q4 Campaign Assets");

// Use namedQuery() for a shared, server-defined query (e.g. the user's Inbox).
var inboxResult = app.namedQuery("inbox");

// Use browseQuery() when you know the exact filter values at script time.
var browseResult = app.browseQuery("WW News", "1st Issue", "News", "Ready");
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
