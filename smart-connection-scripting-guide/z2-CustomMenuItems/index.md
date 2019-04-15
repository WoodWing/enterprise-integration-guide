---
layout: section
title: Smart Connection Custom Menu Items
permalink: 1171-index
---

The context menu of the Documents pane in the Smart Connection panel can be extended with custom menu items. These custom menu items are provided with information by Smart Connection about the selected items, giving the custom menu items the ability to control the enabling of the items. The information passed by Smart Connection is all data from the query result for the selected itema. Custom menu items work in both list and thumbnail view, althought the information passed to the script in thumbnail view is limited.

Custom menu items are added and controlled through a script. The script is placed in the Startup Scripts folder in either the application’s scripts folder or in the user’s scripts folder. The script locations are:

|Platform|Location|
|--------|--------|
|Windows |C:\Documents and Settings\<username>\Application Data\Adobe\InDesign\Version x\<language>\Scripts\Startup Scripts|
||C:\Program Files\Adobe\Adobe InDesign CC\Scripts\Startup Scripts|
|Macintosh |~/Library/Preferences/Adobe InDesign/Version x/<language>/Scripts/Startup Scripts|
||/Applications/Adobe InDesign CC/Scripts/Startup Scripts|

Below is an annotated sample script that adds 3 custom menu items with custom enabling. Important notes:
* Smart Connection expects the naming of the functions in the ScriptMenu object and of the ScriptMenu instance
as shown in the script.
* There can only be one instance of the ScriptMenu object, meaning that if you have several customizations adding
custom menu items, you have to think out a framework for adding custom menu items from these customizations.
* The targetengine must be “scriptmenu”.
* The name of the script file does not matter.
* Any errors occuring need to handled by the script as Smart Connection will simply ignore any errors occuring during the execution of the script functions.

## Examples

**Sample custom menu items script**
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

    /**
     * Tells Smart Connection whether the calls need to be debugged
     *
     * @return array of bool
     * -----------------------------------------
     * debug update? debug run? show error alerts
     * -----------------------------------------
     * [ false, false false ]
     */
    function getDebugConfig()
    {
        return [ false, false, false ];
    }

    /**
     * Provides a list of actions this script supports to the caller
     *
     * @return array of arrays of string
     * -----------------------------------------
     * unique id name
     * -----------------------------------------
     * [ [ "action1", "initialName" ],
     * [ "action2", "initialName" ],
     * [ "action3", "initialName" ] ]
     */
    function getActions()
    {
        var r = [
        [ "1", "Item 1" ],
        [ "2", "Item 2" ],
        [ "3", "Item 3" ] ];
        return r;
    }

    /**
     * update the state of the actions
     *
     * @return array of arrays
     * --------------------------------------------------------------
     * unique id name enabled checked
     * --------------------------------------------------------------
     * [ [ "action1", "name", true, false ],
     * [ "action2", "name", false, false ],
     * [ "action3", "name", true, true ] ]
     */
    function updateState( selectedItemsJson )
    {
        var selectedItems = eval( selectedItemsJson );
        // selectedItems is an array of objects, each representing a selected item
        for( var i = 0; i < selectedItems.length; ++i ) {
            var selItem = selectedItems[i];v
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
        var r = [
        [ "1", "Item 1", true, false ],
        [ "2", "Item 2", false, false ],
        [ "3", "Item 3", true, true ] ];
        return r;
    }

    /**
     * execute the given action. actionId is as defined by getActions
     * Script is responsible for handling all errors.
     */
    function run( selectedItemsJson, actionId )
    {
        // Do something
        alert( actionId );
    }
}

var scriptMenu = new ScriptMenu;
```
