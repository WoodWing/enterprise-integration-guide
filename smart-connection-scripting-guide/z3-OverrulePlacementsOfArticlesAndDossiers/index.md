---
layout: section
title: Overrule placement of Article and Dossiers
sortid: 22
permalink: 1242-index
---

With scripting code it is possible to overrule the placement of whole articles and it is possible to implement the placement of Dossiers. It is currently not possible to overrule the placement of images and article components.

The script in which this can be implemented should be placed into the Startup Scripts folder in either the application’s scripts folder or in the user’s scripts folder. The script locations are:

| Platform  | Script locations                                                                                                  |
| --------- | ----------------------------------------------------------------------------------------------------------------- |
| Windows   | C:\Documents and Settings\<username>\Application Data\Adobe\InDesign\Version x\<language>\Scripts\Startup Scripts |
|           | C:\Program Files\Adobe\Adobe InDesign CC\Scripts\Startup Scripts                                                  |
| Macintosh | ~/Library/Preferences/Adobe InDesign/Version x/<language>/Scripts/Startup Scripts                                 |
|           | /Applications/Adobe InDesign CC/Scripts/Startup Scripts                                                           |

The script should have the following properties:

- The target engine must be “placeoverride” (`#targetengine "placeoverride"`)
- The name of the object must be “PlaceOverride” (`function PlaceOverride`)
- There may only be one object of the PlaceOverride class and this needs to have the name “placeOverride” (`var placeOverride = new PlaceOverride`).
- The PlaceOverride class needs to implement all following functions:

## getDebugConfig

### Parameters

**Return value** _array of boolean_

It returns an array of booleans:

| Nº  | Description          |
| --- | -------------------- |
| 1   | debug canPlaceItems? |
| 2   | debug placeItems?    |
| 3   | show error alerts?   |

### Description

Tells Studio for InDesign and InCopy whether the functions need to be debugged or not.

### Example

```javascript
return [false, false, true];
```

## canPlaceItems

### Parameters

**itemsToPlaceJson** _string_

A string with json content that contains the database ID, type, format and guid of the item to be placed. For 8.3 the guid will always be empty. A sample of such a json string is:

```javascript
[
  {
    itemID: "909",
    type: "Article",
    format: "application/incopyicml",
    guid: "",
  },
];
```

Properties of one item in this json string:

| Name   | Type   | Description                                          |
| ------ | ------ | ---------------------------------------------------- |
| itemID | string | The database id of the item to be placed             |
| type   | string | The type of the item to be placed                    |
| format | string | The format of the item to be placed                  |
| guid   | string | The guid of the component to be placed. Maybe empty. |

**targetLayoutJson** _string_

A string with json content that contains the database ID and type of the target layout. This is always only one item. A sample of such a json string is:

```javascript
[{ itemID: "444", type: "Layout" }];
```

Properties of one item in this json string:

| Name   | Type   | Description                          |
| ------ | ------ | ------------------------------------ |
| itemID | string | The database id of the target Layout |
| type   | string | The type of the target Layout        |

**targetItem** _string_

A string with the id of the target item on the layout. You can get the target item with this piece of code:

```javascript
var targetID = parseInt(targetItem);
var doc = app.activeDocument;
var item = doc.pageItems.itemByID(targetID);
```

The string can also be "0". In that case the target item is unknown.

**Return value** _boolean_

A boolean that indicates if the script is capable of placing the passed item(s) or not.

### Description

Tells Studio for InDesign and InCopy whether this script can place the passed items or not. At this moment this function is only called for Dossiers.

## placeItems

### Parameters

**itemsToPlaceJson** _string_

A string with json content that contains the database ID, type, format and guid of the item to be placed. For 8.3 the guid will always be empty. A sample of such a json string is:

```javascript
[
  {
    itemID: "909",
    type: "Article",
    format: "application/incopyicml",
    guid: "",
  },
];
```

Properties of one item in this json string:

| Name   | Type   | Description                                          |
| ------ | ------ | ---------------------------------------------------- |
| itemID | string | The database id of the item to be placed             |
| type   | string | The type of the item to be placed                    |
| format | string | The format of the item to be placed                  |
| guid   | string | The guid of the component to be placed. Maybe empty. |

**targetItem** _string_

A string with the id of the target item on the layout. You can get the target item with this piece of code:

```javascript
var targetID = parseInt(targetItem);
var doc = app.activeDocument;
var item = doc.pageItems.itemByID(targetID);
```

The string can also be "0". In that case the target item is unknown.

**targetPage** _number_

0-based page number that matches the passed targetPointJson. It can directly be used in the myDoc.pages.item(<page_num>) scripting call.

**targetPointJson** _string_

a piece of json that describes the target position. This can be one point (when doing a drag and drop or click) or two points when dragging a rectangle as target position. Examples of this json:

One point:

```javascript
[{ x: "36", y: "36" }];
```

Two points:

```javascript
[
  { x: "36", y: "470" },
  { x: "199", y: "568.8" },
];
```

Properties of one point:

| Name | Type   | Description             |
| ---- | ------ | ----------------------- |
| x    | string | x position of the point |
| y    | string | y position of the point |

**Return value** _array with boolean and array of number_

The return value is an array with two values:

| Nº  | Type            | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| --- | --------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| 1   | boolean         | Indicates if the script handled the place or not. If this boolean is true the script handled the placement and Studio should not perform its place code. If this boolean is false the script did not handle the placement and Studio should perform its place code. Studio is not able to place Dossiers. If the script to place a dossier returns false Studio for InDesign and InCopy will empty the place gun. |
| 2   | array of number | This is an array of ids of the items that are placed or replaced by the scripting code. If this list is empty and the boolean was true the Studio place code is not called and the place gun is still loaded. If this list contains items the Studio place code is not called and the place gun will be emptied.                                                                                                                  |

An example of the return value is:

```javascript
var arr = new Array();
arr.push(123);
arr.push(456);
return [true, arr];
```

### Description

Called to override the default placement functionality of articles. Depending on the returned information the Studio for InDesign and InCopy code will perform or not perform its own place code. Also called to place Dossiers if the canPlaceItems call returned true. The Studio for InDesign and InCopy code is not capable of placing Dossiers.

## Sample script

The following script shows the parameters to the user that are passed to the placeItems call.

At the end we tell Studio that we handled the placement, but since nothing is placed the place gun will not be unloaded.

```javascript
#targetengine "placeoverride"
function PlaceOverride()
{
    // initialize the member function references
    // for the class prototype
    if (typeof(_PlaceOverride_prototype_called) == 'undefined')
    {
        _PlaceOverride_prototype_called = true;
        PlaceOverride.prototype.getDebugConfig = getDebugConfig;
        PlaceOverride.prototype.placeItems = placeItems;
        PlaceOverride.prototype.canPlaceItems = canPlaceItems;
    }
    // - getDebugConfig -
    function getDebugConfig()
    {
        // Tell Studio not to debug, but to show alerts.
        return [ false, false, true ];
    }
    // - canPlaceItems -
    function canPlaceItems( itemsToPlaceJson, targetLayoutJson, targetItem )
    {
        // Tell Studior that we are able to place the passed
        // item.
        return true;
    }
    // - placeItems -
    function placeItems( itemsToPlaceJson, targetItem, targetPage, targetPointJson )
    {
        // Collect information about the passed parameters and show it to the user
        // itemToPlaceJson contains about the item to be placed.
        var message = "Json input itemToPlaceJson : \n" + itemsToPlaceJson +"\n\nInterpreted items from Json: \n";
        // Interpret the Json
        var itemsToPlace = eval( itemsToPlaceJson );
        for( var i=0 ; i < itemsToPlace.length ; i++ )
        {
                message = message + "Item " + i + ":\n";
                message = message + "   itemID = " + itemsToPlace[i].itemID + "\n";
                message = message + "   type = " + itemsToPlace[i].type + "\n";
                message = message + "   format = " + itemsToPlace[i].format + "\n";
                message = message + "   guid = " + itemsToPlace[i].guid + "\n\n";
        }
        // Show the collected information about the items to be placed to the user.
        alert( message );
        // Show the id of the target item to the user. This is passed as string with the targetItem parameter.
        alert( "targetItem : \n   " + targetItem );
        // Show the number of the target page to the user. This is passed as string with the targetPage parameter.
        alert( "targetPage : \n   " + targetPage );
        // targetPointJson contains about the target position.
        var pos_message = "Json input targetPointJson : \n" + targetPointJson + "\n\nInterpreted points from Json: \n";
        // Interpret the Json
        var targetPos = eval( targetPointJson );
        for( var i=0 ; i < targetPos.length ; i++ )
        {
                pos_message = pos_message + "Point " + i + ":\n";
                pos_message = pos_message + "   x = " + targetPos[i].x + "pt\n";
                pos_message = pos_message + "   y = " + targetPos[i].y + "pt\n\n";
        }
        // Show the collected information about the target position.
        alert( pos_message );
        // Tell Studio that we handled the placement,
        // but we did not place anything. So the placegun is not unloaded.
        var arr = new Array();
        return [ true, arr ];
    }
}
var placeOverride = new PlaceOverride;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2022          | ✔         |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
