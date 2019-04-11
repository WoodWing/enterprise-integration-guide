---
layout: section
title: Scripting Events
permalink: 1205-index
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
