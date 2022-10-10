---
layout: section
title: Overrule adding created images to a Dossier
sortid: 23
permalink: 1243-index
---

When an image that is stored in Assets/Elvis is turned into an image that is stored in Studio or Enterprise Server, it is by default added to a Dossier. This action can be overruled with scripting code.

The script in which this can be implemented should be placed into the Startup Scripts folder in either the application’s scripts
folder or in the user’s scripts folder. The script locations are:

| Platform  | Script locations                                                                                                  |
| --------- | ----------------------------------------------------------------------------------------------------------------- |
| Windows   | C:\Documents and Settings\<username>\Application Data\Adobe\InDesign\Version x\<language>\Scripts\Startup Scripts |
|           | C:\Program Files\Adobe\Adobe InDesign CC\Scripts\Startup Scripts                                                  |
| Macintosh | ~/Library/Preferences/Adobe InDesign/Version x/<language>/Scripts/Startup Scripts                                 |
|           | /Applications/Adobe InDesign CC/Scripts/Startup Scripts                                                           |

The script should have the following properties:

- The target engine must be “elvisobjectoverride” (`#targetengine "elvisobjectoverride"`).
- The name of the object must be “AddToDossierOverride” (`function AddToDossierOverride`).
- There may only be one object of the AddToDossierOverride class and this needs to have the name “addToDossierOverride”
  (`var addToDossierOverride = new AddToDossierOverride`).

The AddToDossierOverride class needs to have the following functions:

## getDebugConfig

### Parameters

**Return value** _Array of Boolean_

It returns an array of bool:

| Nº  | Description          |
| --- | -------------------- |
| 1   | debug canPlaceItems? |
| 2   | debug placeItems?    |
| 3   | show error alerts?   |

Example:

```javascript
return [false, false, true];
```

### Description

Tells Studio or Smart Connection whether the functions need to be debugged or not.

## addObjectsToDossier

### Parameters

**objectsToAddJson** _string_

A string with json content that contains the database ID and page item of the objects to be added to a Dossier. A sample of such a json string is:

```javascript
[{ objectID: "909", pageItem: "123" }];
```

Properties of one item in this json string:

| Name     | Type   | Description                               |
| -------- | ------ | ----------------------------------------- |
| objectID | string | The database id of the object to be added |
| pageItem | string | The page item id of the object            |

**targetDossier** _string_

A string with the database id of the Dossier that was found by the Studio or Smart Connection code as default Dossier.

**showSelectDossierDialog** _string_

A string (“true” or “false”) that indicates if the Studio or Smart Connection code finds that it is needed to show the Select Dossier dialog or not.

**suppressUI** _boolean_

Should any user interface be suppressed or not.

**Return value** _Array of Boolean and Strings_

The return value is an array with three values:

| Nº  | Type    | Description                                                                                                                                              |
| --- | ------- | -------------------------------------------------------------------------------------------------------------------------------------------------------- |
| 1   | boolean | Indicates if the Studio or Smart Connection code to add the objects to the Dossier should be performed or not.                                           |
| 2   | string  | The database id of the Dossier to which the object should be added to by the Studio or Smart Connection code. (not used when the first boolean is false) |
| 3   | string  | Indicates if the Select Dossier dialog should be shown or not (“true” or “false”). (not used when the first boolean is false)                            |

A sample of the return value is:

```javascript
return [true, "123", "false"];
```

### Description

Called to override the default Dossier that is used to add the objects to. Depending on the returned information, the Studio or Smart Connection code will use the updated target Dossier, show the Select Dossier dialog, or does not do anything.

## Sample script

The following script shows the parameters to the user that are passed to the addObjectsToDossier call. At the end we tell Studio or Smart Connection that it can add the objects to the Dossier.

```javascript
#targetengine "elvisobjectoverride"
function AddToDossierOverride()
{
    // initialize the member function references
    // for the class prototype
    if (typeof(_AddToDossierOverride_prototype_called) == 'undefined')
    {
        _AddToDossierOverride_prototype_called = true;
        AddToDossierOverride.prototype.getDebugConfig = getDebugConfig;
        AddToDossierOverride.prototype.addObjectsToDossier = addObjectsToDossier;
    }

    // - getDebugConfig -
    function getDebugConfig()
    {
        // Tell Studio or Smart Connection not to debug, but to show alerts.
        return [ false, false, true ];
    }

    // - addObjectsToDossier -
    function addObjectsToDossier( objectsToAddJson, targetDossier, showSelectDossierDialog, suppressUI )
    {
        // Collect information about the passed parameters and show it to the user
        // objectToAddJson contains about the items to be added to a dossier.
        var message = "Json input objectsToAddJson : \n" + objectsToAddJson +"\n\nInterpreted items from Json: \n";
        // Interpret the Json
        var objectsToAdd = eval( objectsToAddJson );
        for( var i=0 ; i < objectsToAdd.length ; i++ )
        {
            message = message + "Object " + i + ":\n";
            message = message + " objectID = " + objectsToAdd[i].objectID + "\n";
            message = message + " pageItem = " + objectsToAdd[i].pageItem + "\n\n";
        }
        message = message + "targetDossier = " + targetDossier + "\n\n";
        message = message + "showSelectDossierDialog = " + showSelectDossierDialog + "\n\n";
        message = message + "suppressUI = " + suppressUI + "\n\n";
        alert( message );
        // Tell Studio or Smart Connection that to continue with adding the objects
        // to the dossier
        return [ true, targetDossier, showSelectDossierDialog ];
    }
}
var addToDossierOverride = new AddToDossierOverride;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2020          | ✔         |
| 2021          | ✔         |
| 2022          | ✔         |
| 2023          | ✔         |
