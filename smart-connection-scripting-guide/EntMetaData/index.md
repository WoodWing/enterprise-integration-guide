---
layout: section
title: EntMetaData
permalink: 1221-index
---

EntMetaData is a scripting object that manages a collection of properties in the form of key value pairs. EntMetaData objects are
proxy objects: changes to the EntMetaData scripting object are not applied directly to the underlying InDesign object. Instead,
the changed metadata is kept in memory and used in actions towards the Enterprise system initiated from scripting. These
actions do change the underlying InDesign objects and afterwards the EntMetaData object is updated.

### Keys

The keys used for the properties in the EntMetaData are the same as the field name properties. For a complete overview, see the Action property in the Enterprise Admin Guide. Custom properties are identified by their name prefixed with ‘C_’. 

Below is a list with common properties, exceptions and sample values.

|Key |Type |Description |Sample Value|
|----|-----|------------|------------|
|Core_ID |string |Object ID |"123"|
|Core_Name |string |Name |"32_Intro"|
|Core_Publication |string |Brand |"WW News"|
|Core_Issue |string |Issue |"2nd Issue"|
|Core_Section |string |Category |"News"|
|Core_Basket |string |Status |"Ready"|
|Type |string |Object Type |"Article", "Image"|
|LockedBy |string |In use by |"woodwing"|
|RouteTo |string |Routed to |"woodwing"|
|Comment |string |Comment |"This image needs retouching"|
|Format |string |Object Format |"application/indesign"|
|Editions |Array of string |Editions |[ "North, “South" ]|
|Deadline |string |Deadline |"2007-11-05T18:00:00"|
|CopyrightMarked |string |Copyright Marked |"false"|
|C_ACUSTOMPROP |string |Custom property 'A custom prop' |"A value"|

### Properties

* [length](Properties/length.md)

### Methods

* [count](Methods/count.md)
* [get](Methods/get.md)
* [has](Methods/has.md)
* [item](Methods/item.md)
* [refresh](Methods/refresh.md)
* [remove](Methods/remove.md)
* [set](Methods/set.md)
