---
layout: chapter
title: afterGeometryNotification
sortid: 120
permalink: 1247-afterGeometryNotification
---

## When

After receiving a Geometry Update notification from Studio Server in InCopy

## Where

![]({{ site.baseurl }}{% link smart-connection-scripting-guide/images/incopy.png %})

## Arguments in

| Key     | Description                                   |
| ------- | --------------------------------------------- |
| Core_ID | The object id of the layout that was updated. |
| geometryUpdateState<sup>①</sup> | The impact of the geometry update for the article in InCopy. |

① Notes about the argument _geometryUpdateState_:
* _geometryUpdateState_ is available since versions 17.0.6 and 18.0.3.
* For the argument _geometryUpdateState_ possible values are:
  * **HighPriority** _the position and/or size of the article being edited is touched_
  * **LowPriority** _the geometry of the article is not touched. The layout has been changed._

## Arguments out

n/a

## Examples

**Using afterGeometryNotification and app.UpdateGeometry**

```javascript
#targetengine 'session';

var myIdleTask = app.idleTasks.add({name:"one_off_idle_task", sleep:1});

var layoutId = app.scriptArgs.get( 'Core_ID' );
var geometryUpdateState = "HighPriority";
geometryUpdateState = app.scriptArgs.get( 'geometryUpdateState' );

var onIdleEventListener = myIdleTask.addEventListener(IdleEvent.ON_IDLE,
	function() {
		try {
			afterReceivingGeometry();
			var myIdleTaskName = "one_off_idle_task";
			var myIdleTask = app.idleTasks.itemByName(myIdleTaskName);
			if (myIdleTask != null)
					myIdleTask.remove();

		} catch (err) {
			alert("Script afterGeometryNotification failed.");
		}
	}
);

function afterReceivingGeometry() {
	try{
		doUpdateGeometry();
	}
	catch(e){
		alert( "ERROR: in afterGeometryNotification script: " + e.name + "\n\n" + e.message + "\n\nFound on line " + e.line );
	}
}

function doUpdateGeometry() {
	app.scriptPreferences.userInteractionLevel = UserInteractionLevels.INTERACT_WITH_ALL;
	var articleNames = getArticleNames( layoutId );
	if ( articleNames.length > 0 ) {
		if( geometryUpdateState == "HighPriority") {
	
			var result = confirm("New layout information is available for article [ " + articleNames + " ]. " + "Do you want to update now?", false);
			if( result == true ) {
				try {
					app.updateGeometry(layoutId);
				}
				catch (e) {
					alert("Cannot update geometry from the script, the updateGeometry action have wrong layout id value. Please fix the script and try again.");
				}
			}
		}
	}
}

function getArticleNames( layoutId ) {
	var articleNames = "";
	try
	{
		var openDocs = app.documents;
		var doc;
		for (var i = 0; i < openDocs.length; i++) {
			doc = openDocs[i];
			if (!doc.entMetaData.has("Core_ID") )
				continue;
			var docId = doc.entMetaData.get( "Core_ID" );
			if (docId == layoutId) {
				var managedArticles = doc.managedArticles;
				var masLen = managedArticles.length;
				var managedArticle, md, artName, lockedBy;
				for( var artIdx = 0; artIdx < masLen; ++artIdx ) {
					managedArticle = managedArticles.item(artIdx);
					md = managedArticle.entMetaData;

					if( md.has( "Core_Name" ) && md.has( "LockedBy" )) {
						lockedBy = md.get("LockedBy");
						if( lockedByUser(lockedBy) ) {
							artName = md.get( "Core_Name" );
							if (articleNames.length > 0) {
								articleNames += ", ";
							}
							articleNames += artName;
						}
					}
				}
			}
		}
	} catch (e) {
		alert( "ERROR: in afterGeometryNotification script: " + e.name + "\n\n" + e.message + "\n\nFound on line " + e.line );
	}

	return articleNames;
}

function lockedByUser(lockName)
{
	var activeUser = "";
	if ("activeUser" in app.entSession) {
		activeUser = app.entSession.activeUser.toLowerCase();
	}
	lockName = lockName.toLowerCase();

	// Get all users on the current server
	var users = app.entSession.getUsers();

	// Check if the lock name can be tied to our user
	var userName, fullName;
	for(var i = 0; i < users.length; i++)
	{
		userName = users[i][0].toLowerCase();
		fullName = users[i][1].toLowerCase();

		if(activeUser == userName || activeUser == fullName) {
			if (lockName == userName || lockName == fullName) {
				// The shortname or longname matches,
				return true;
			}
		}
	}
	// Someone else locked the file.
	return false;
}
```

## Supported versions

| Adobe Version | Supported  |
| ------------- | ---------- |
| 2022          | ✔          |
| 2023          | ✔          |
| 2024          | ✔          |
| 2025          | ✔          |

## See also

- [Scripting Events](./index.md)
