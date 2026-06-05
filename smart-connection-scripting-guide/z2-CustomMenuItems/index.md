---
layout: section
title: Custom menu items
permalink: 1241-index
---

The context menu of the Documents pane in the Studio for InDesign and InCopy panel can be extended with custom menu items. These custom menu items are provided with information by Studio for InDesign and InCopy about the selected items, giving the custom menu items the ability to control the enabling of the items. The information passed by Studio for InDesign and InCopy is all data from the query result for the selected items. Custom menu items work in both list and thumbnail view, although the information passed to the script in thumbnail view is limited.

Custom menu items are added and controlled through a script. The script is placed in the Startup Scripts folder in either the application's scripts folder or in the user's scripts folder. The script locations are:

| Platform  | Application | Script locations                                                                                                    |
| --------- | ----------- | ------------------------------------------------------------------------------------------------------------------- |
| Windows   | InDesign    | C:\Documents and Settings\<username>\Application Data\Adobe\InDesign\Version x\<language>\Scripts\Startup Scripts  |
|           |             | C:\Program Files\Adobe\Adobe InDesign CC\Scripts\Startup Scripts                                                    |
|           | InCopy      | C:\Documents and Settings\<username>\Application Data\Adobe\InCopy\Version x\<language>\Scripts\Startup Scripts    |
|           |             | C:\Program Files\Adobe\Adobe InCopy CC\Scripts\Startup Scripts                                                      |
| Macintosh | InDesign    | ~/Library/Preferences/Adobe InDesign/Version x/<language>/Scripts/Startup Scripts                                  |
|           |             | /Applications/Adobe InDesign CC/Scripts/Startup Scripts                                                             |
|           | InCopy      | ~/Library/Preferences/Adobe InCopy/Version x/<language>/Scripts/Startup Scripts                                    |
|           |             | /Applications/Adobe InCopy CC/Scripts/Startup Scripts                                                               |

The script should have the following properties:

- The target engine must be "scriptmenu" (`#targetengine "scriptmenu"`).
- The name of the object must be "ScriptMenu" (`function ScriptMenu`).
- There may only be one instance of the ScriptMenu object, and this needs to have the name "scriptMenu" (`var scriptMenu = new ScriptMenu`). If multiple customizations need to add custom menu items, a shared framework must be used to combine them into a single ScriptMenu implementation.
- The ScriptMenu class needs to implement all following functions.
- A maximum of 20 custom menu items is supported.
- The name of the script file does not matter.
- Any errors that occur need to be handled by the script, as Studio for InDesign and InCopy will ignore any errors during script execution.

## getDebugConfig

### Parameters

**Return value** _array of boolean_

It returns an array of booleans:

| Nº  | Description        |
| --- | ------------------ |
| 1   | debug updateState? |
| 2   | debug run?         |
| 3   | show error alerts? |

### Description

Tells Studio for InDesign and InCopy whether the functions need to be debugged or not. Called once when the ScriptMenu is first initialized.

### Example

```javascript
return [false, false, true];
```

## getActions

### Parameters

**Return value** _array of arrays of string_

It returns an array of arrays, where each inner array represents one custom menu item:

| Nº  | Type   | Description                           |
| --- | ------ | ------------------------------------- |
| 1   | string | Unique identifier for the menu item   |
| 2   | string | Initial display name of the menu item |

### Description

Provides the list of custom menu items to Studio for InDesign and InCopy. Called once when the ScriptMenu is first initialized. The identifiers returned here are used in `updateState` and `run` to identify individual menu items.

### Example

```javascript
return [
    ["1", "My First Action"],
    ["2", "My Second Action"],
    ["3", "My Third Action"]
];
```

## updateState

### Parameters

**selectedItemsJson** _string_

A string with JSON content that describes the currently selected items in the Studio panel. A sample of such a JSON string is:

```javascript
[
  {
    itemType: "normal",
    values: {
      ID: "909",
      Name: "My Article",
      Type: "Article",
      Format: "application/incopyicml",
    },
  },
];
```

Properties of one item in this JSON string:

| Name     | Type   | Description                                                                                          |
| -------- | ------ | ---------------------------------------------------------------------------------------------------- |
| itemType | string | The type of the selected item: `"normal"` for a regular item, `"component"` for an article component |
| values   | object | An object containing the query result field values of the selected item as key/value string pairs    |

Properties always available in the `values` object:

| Name     | Type   | Description                                                                         |
| -------- | ------ | ----------------------------------------------------------------------------------- |
| ID       | string | The database id of the selected item                                                |
| ParentID | string | The database id of the parent article. Only present when `itemType` is `"component"` |
| Name     | string | The name of the item                                                                |
| Type     | string | The object type of the item (e.g. `"Article"`, `"Image"`, `"Dossier"`)             |
| Format   | string | The format of the item (e.g. `"application/incopyicml"`)                            |

In list view, all other query result fields are also available as properties of `values`, except `Snippet` and `Slugline`. In thumbnail view, only the properties listed in the table above are available.

Use `hasOwnProperty()` to check whether an optional field exists before accessing it.

**Return value** _array of arrays_

An array of arrays, one entry per action, each with the current state of the menu item:

| Nº  | Type    | Description                                                       |
| --- | ------- | ----------------------------------------------------------------- |
| 1   | string  | Unique identifier for the menu item (as returned by `getActions`) |
| 2   | string  | Display name of the menu item (may be updated dynamically)        |
| 3   | boolean | Whether the menu item is enabled                                  |
| 4   | boolean | Whether the menu item is checked                                  |

### Description

Called by Studio for InDesign and InCopy each time before showing the context menu. Returns the current enabled and checked state for each action, along with the display name to show. The display name can be updated dynamically based on the selected items.

## run

### Parameters

**selectedItemsJson** _string_

A string with JSON content that describes the currently selected items in the Studio panel. See [updateState](#updatestate) for the format description.

**actionId** _string_

The unique identifier of the menu item that was clicked, as defined in `getActions`.

### Description

Called when the user clicks a custom menu item. The script is responsible for handling all errors that occur during execution.

## Sample script

The following script shows a complete implementation with three custom menu items. The `updateState` function demonstrates how to access the selected item data.

```javascript
#targetengine "scriptmenu"
function ScriptMenu()
{
    // initialize the member function references
    // for the class prototype
    if (typeof(_ScriptMenu_prototype_called) == 'undefined')
    {
        _ScriptMenu_prototype_called = true;
        ScriptMenu.prototype.getDebugConfig = getDebugConfig;
        ScriptMenu.prototype.getActions = getActions;
        ScriptMenu.prototype.updateState = updateState;
        ScriptMenu.prototype.run = run;
    }

    // - getDebugConfig -
    function getDebugConfig()
    {
        // Tell Studio not to debug, but to show alerts.
        return [ false, false, true ];
    }

    // - getActions -
    function getActions()
    {
        return [
            [ "1", "Item 1" ],
            [ "2", "Item 2" ],
            [ "3", "Item 3" ]
        ];
    }

    // - updateState -
    function updateState( selectedItemsJson )
    {
        var selectedItems = eval( selectedItemsJson );
        // selectedItems is an array of objects, each representing a selected item
        for( var i = 0; i < selectedItems.length; ++i ) {
            var selItem = selectedItems[i];
            // The type of item that is selected. Either 'normal' or 'component'.
            // The available properties (see below) depend on this type.
            var itemType = selItem.itemType;
            // Each item has key/value pairs representing the fields
            // shown in the query result. These are added as properties
            // to the object
            var id = selItem.values.ID;
            var t = selItem.values.Type;
            // Check a certain field exists
            var f = "";
            if( selItem.values.hasOwnProperty( "Format" ) )
                f = selItem.values.Format;
            // Iterate over all properties
            var vals = selItem.values;
            for( var k in vals ) {
                var v = vals[k];
            }
        }

        // Build a return value, normally based on the selected items.
        return [
            [ "1", "Item 1", true, false ],
            [ "2", "Item 2", false, false ],
            [ "3", "Item 3", true, true ]
        ];
    }

    // - run -
    function run( selectedItemsJson, actionId )
    {
        // Do something based on actionId
        alert( actionId );
    }
}

var scriptMenu = new ScriptMenu;
```

## Supported versions

| Adobe Version | Supported |
| ------------- | --------- |
| 2023          | ✔         |
| 2024          | ✔         |
| 2025          | ✔         |
| 2026          | ✔         |
