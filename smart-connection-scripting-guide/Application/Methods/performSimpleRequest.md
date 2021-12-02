---
layout: chapter
title: performSimpleRequest
sortid: 7
permalink: 1083-performSimpleRequest
---
## Syntax

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesign.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %}) ![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/indesignserver.png %})
```javascript
app.performSimpleRequest(anyUrl);
```

### Parameters

**anyUrl** *string*

Any valid URL.

**Return value** *string*

A string containing the complete and total server response.

## Description

The `performSimpleRequest()` calls a URL and returns the response as a string.

## Examples

** Call phpinfo.php on a local Studio Server**

```javascript
var sURL = "http://localhost/StudioServer/server/wwtest/phpinfo.php";

var sResult = app.performSimpleRequest( sURL );

// Chop the result for display purposes
if( sResult.length > 200 )
{
	sResult = sResult.substr( 0, 200 );
	sResult += "...";
}

alert( sResult );
```

## Supported versions

| Adobe Version | Supported |
|---------------|-----------|
| CC 2019       | ✔         |
| 2020          | ✔         |
| 2021          | ✔         |
| 2022          | ✔         |
