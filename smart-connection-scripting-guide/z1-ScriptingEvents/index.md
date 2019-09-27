---
layout: section
title: Scripting Events
sortid: 21
permalink: 1240-index
---
Scripting events allow the integrator to perform scripts on a number of events occurring in the InDesign and InCopy application. Currently scripts can be executed around saving, opening and placing.

### Setup
By default Smart Connection looks for scripts named exactly the same as the event with a ‘.jsx’ extension in the application’s scripts folder. For example the script for the afterPlace event will be afterPlace.jsx. The default locations are:

**Windows** C:\Documents and Settings\<username>\Application Data\Adobe\InDesign\Version <x>\Scripts\Scripts Panel

**Macintosh** ~/Library/Preferences/Adobe InDesign/Version <x>/Scripts/Scripts Panel

Should you require a different location for the scripts or different names, then these can be modified by adding a ScriptingEvents element to wwsettings.xml:

```xml
<!-- Windows -->
<SCEnt:ScriptingEvents>
    <!--
    Use the target attribute to specify for which application it will be used. Omitting the attribute will result
    in the path being used for all applications.
    -->
    <SCEnt:ScriptsFolderPath target="InCopy">C:\IDScripts</SCEnt:ScriptsFolderPath>
    <!--
    Specify script names when you want to use the same script for multiple events.
    -->
    <SCEnt:Script event="afterOpenLayout">bla.jsx</SCEnt:Script>
    <SCEnt:Script event="beforeSaveLayout">bla.jsx</SCEnt:Script>
</SCEnt:ScriptingEvents>

<!-- Macintosh -->
<SCEnt:ScriptingEvents>
    <SCEnt:ScriptsFolderPath target="InCopy">Macintosh HD:IDScripts</SCEnt:ScriptsFolderPath>
    <SCEnt:Script event="afterOpenLayout">bla.jsx</SCEnt:Script>
    <SCEnt:Script event="beforeSaveLayout">bla.jsx</SCEnt:Script>
</SCEnt:ScriptingEvents>
```

#### ScriptsFolderPath element
The ScriptsFolderPath element points to the location where scripts are located. Use HFS path names for Mac OS X. It can occur zero or more times.
The optional target attribute indicates in which application the path should be used. Accepted values are InCopy and InDesign. All other values are ignored and have the same result as omitting the attribute. If the element omits this attribute, the path will be used for all applications. An element with a target attribute takes precedence over an element without one.

#### Script element
Defines per named event which script needs to be run. Event names are equal to the list in the Events section. For events not defined in the WWsettings.xml file, the default name will be used.

### Conflicts
In some rare occasions conflicts occur between an event and the scripted actions executed at that event.
An example is an afterCreateArticle.jsx script which performs a check-out operation of the just created article.
The conflict here is that when the user creates an article and thus the script starts executing,
Smart Connection might not have finalised all actions related to article creation such as locking all related (article) components.
As a result the scripted check-out operation fails as the specified component is not locked or no locked components are found.

These type of issues can be solved by modifying the script slightly.
The example code below shows how this can be done.
In the modified afterCreateArticle.jsx script all initial actions are cast in a new function like the afterCreateArticle() below.
Furthermore two variables are added: an idle task and a listener.
What now happens when the script is invoked (by the afterCreateArticle event) is that _only_ an idle task is created.
Hereafter Smart Connection continues its execution. When Smart Connection has finalised all actions related to the creation of the article it becomes idle.
On that moment the script performs the specified idle tasks being: the execution of the afterCreateArticle() function and the removal of its own task (such that it executes only once).

```javascript
#targetengine 'session';

var myIdleTask = app.idleTasks.add({name:"one_off_idle_task", sleep:1});
		
var onIdleEventListener = myIdleTask.addEventListener(IdleEvent.ON_IDLE, 
	function() {
		try {
			afterCreateArticle();
			var myIdleTaskName = "one_off_idle_task";
			var myIdleTask = app.idleTasks.itemByName(myIdleTaskName); 
			if (myIdleTask != null)
					myIdleTask.remove();
	
		} catch (err) {
			alert("script failed...");
		}
	}
);


function afterCreateArticle()
{
	...
}
```

### Troubleshooting
It is possible to debug scripts on a per event basis when an event occurs. To debug the afterOpenLayout event:
```xml
<SCEnt:ScriptingEvents>
    <SCEnt:Script debug="true" event="afterOpenLayout">bla.js</SCEnt:Script>
    <SCEnt:Script event="beforeSaveLayout">bla.jsx</SCEnt:Script>
</SCEnt:ScriptingEvents>
```

The events mechanism has its own logging which can be enabled through the WWsettings.xml file. This will show which script will be run and whether running is successful:
```xml
<Logging level="0" allareas="0">
    <Area name="ScriptingEvents"/>
</Logging>
```

### Events

The following fields are used to describe an event:

|Field|Description|
|-----|-----------|
|When |Describes at what moment the event occurs.|
|Where |Describes in what applications the event occurs.|
|Arguments in |Table describing key value pairs set in app.scriptArgs for the event.|
|Arguments out |Table describing key value pairs that a script can set in app.scriptArgs for the event.|
|Notes |Event related notes.|

* [afterCreateArticle](./Events/afterCreateArticle.md)
* [afterCreateArticleTemplate](./Events/afterCreateArticleTemplate.md)
* [afterCreateContinuationElement](./Events/afterCreateContinuationElement.md)
* [afterCreateEnterpriseImageFromElvisImage](./Events/afterCreateEnterpriseImageFromElvisImage.md)
* [afterCreateJump](./Events/afterCreateJump.md)
* [afterCreateLayout](./Events/afterCreateLayout.md)
* [afterCreateLayoutTemplate](./Events/afterCreateLayoutTemplate.md)
* [afterDetachArticle](./Events/afterDetachArticle.md)
* [afterExportArticle](./Events/afterExportArticle.md)
* [afterExportArticleTemplate](./Events/afterExportArticleTemplate.md)
* [afterLogOn](./Events/afterLogOn.md)
* [afterOpenArticle](./Events/afterOpenArticle.md)
* [afterOpenLayout](./Events/afterOpenLayout.md)
* [afterPlace](./Events/afterPlace.md)
* [afterRefreshArticle](./Events/afterRefreshArticle.md)
* [afterRefreshImage](./Events/afterRefreshImage.md)
* [afterSaveArticle](./Events/afterSaveArticle.md)
* [afterSaveLayout](./Events/afterSaveLayout.md)
* [beforeCreateArticle](./Events/beforeCreateArticle.md)
* [beforeCreateArticleTemplate](./Events/beforeCreateArticleTemplate.md)
* [beforeCreateLayout](./Events/beforeCreateLayout.md)
* [beforeCreateLayoutTemplate](./Events/beforeCreateLayoutTemplate.md)
* [beforeDetachArticle](./Events/beforeDetachArticle.md)
* [beforeExportArticle](./Events/beforeExportArticle.md)
* [beforeExportArticleTemplate](./Events/beforeExportArticleTemplate.md)
* [beforeImportImage](./Events/beforeImportImage.md)
* [beforeLogOff](./Events/beforeLogOff.md)
* [beforePlace](./Events/beforePlace.md)
* [beforeSaveArticle](./Events/beforeSaveArticle.md)
* [beforeSaveLayout](./Events/beforeSaveLayout.md)
