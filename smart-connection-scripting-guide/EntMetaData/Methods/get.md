---
layout: chapter
title: get
sortid: 35
permalink: 1223-get
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
EntMetaData.get(key);
```

### Parameters

**key** *string* 

The property key.

**Return value** *string, Array of string, number, Array of number, boolean or Array of boolean*

The property value for the given key. If the key does not exist, an error will be thrown.

## Description

The `get()` method returns the property value for the given key. 

## Examples

**Iterating metadata properties**

```javascript
try
{
    var doc = app.documents.item(0);
    
    // Access the document’s metadata
    var md = doc.entMetaData;

    // Iterate the metadata keys and values
    for( var i = 0; i < md.length; ++i )
    {
        var keyValue = md.item( i );
        $.writeln( "Key: [" + keyValue[0] + "], Value: [" + keyValue[1] +"]");
    }

    // Access the value of a specific key
    var mdName = md.get("Core_Name" );
    $.writeln( "Name: [" + mdName + "]" );
    var mdID = md.item("Core_ID");
    $.writeln( "ID: [" + mdID + "]" );
}
catch( e)
{
    desc = e.description;
    num = e.number;
    alert( "error " + num + ": " + desc );
}
```

## Supported versions

| Adobe Version | Supported |
|---------------|---------|
| CC            | ✔       |
| CC 2014       | ✔       |
| CC 2015       | ✔       |
| CC 2017       | ✔       |
| CC 2018       | ✔       |
| CC 2019       | ✔       |