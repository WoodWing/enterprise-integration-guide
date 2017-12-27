---
layout: chapter
title: Object Targets
sortid: 030
permalink: 1058-object-targets
---
Objects can be targeted for an Issue. This means it is intended to get published for that Issue. During creation, or 
at the end of the selection & gathering phase, objects typically get targeted. During production, users could add 
(or remove) targets to send them through additional publication channels. After production, admin users might postpone 
some objects (that could not get published) to the next Issue by changing targets. With Enterprise 5 (or earlier), 
objects were always targeted for just one Issue though.

Objects can have zero, one or many targets. Zero targets are especially needed to support selection & gathering. Many 
targets are needed to support multiple channeling.

The left the figure below shows some example objects targeted for several Issues. Targets are represented by dashed 
arrows. Each Issue belongs to a certain channel, such as “Euro Site” which belongs to the “Web” channel. The figure 
on the right shows how the abstract Enterprise entities are related to each other.

![]({{ site.baseurl }}{% link web-services-guide/images/image31.png %})

### Target Editions

For print channels, admin users can setup Editions per channel. (This is done by means of the Maintenance pages, see 
the Admin Guide for details.) When an object is targeted for an Issue that belongs to a print channel, end users can 
select any of the configured Editions in the workflow dialogs. Selected Editions are tracked by Enterprise per target. 
The figure to the right illustrates how Editions relate to targets. (It zooms into a fragment of the target example 
shown above.) As shown, the user has selected three Editions for the target.
 
![]({{ site.baseurl }}{% link web-services-guide/images/image32.png %}) 

When the object should be targeted for all Editions, client applications should pass xsi:nil=”true” attribute for 
the *Editions* element. This is an exceptional meaning of the nil attribute; for other entities (other than Editions) 
nil means that the data is not provided, which implies existing data needs to remain untouched in the database.

### Object targets

During create and save operations (CreateObjects and SaveObjects workflow services) the object targets can be set. 
These operations only work for objects that are locked by the current user.

**Important**: When an object is locked for editing by the current user, its targets can be set by other users in 
the meantime. Therefore, the targets sent through the create and save operations are assumed to be complete.

> Since Enterprise 6, the `TargetMetaData` element is obsolete. (For more details, see *Structural change for multiple channels*.) 
Instead, the `Targets` element should be used and the `TargetMetaData` element should be nullified (by setting the 
`xsi:nil="true"` attribute).

Example of `Target` usage:

```xml
<Object>
	<MetaData>
		...
		<TargetMetaData xsi:nil="true" />
		...
	<Targets>
		<Target>
			<Issue>
				<Id>421</Id>
				<Name>USA Magazine</Name>
			</Issue>
			<Editions>
				<Edition>
					<Id>801</Id>
					<Name>West USA</Name>
				</Edition>
				<Edition>
					<Id>802</Id>
					<Name>Central USA</Name>
				</Edition>
				...
```

When objects are locked by someone else, client applications can still change the object targets. This can be done by 
calling the following workflow services:

- CreateObjectTargets
- UpdateObjectTargets
- DeleteObjectTargets

**Important:** Similar to the create/save operations, the *UpdateObjectTargets* service assumes that the passed object 
targets are complete.

### Related targets

Objects can inherit targets from other objects. This typically happens when objects are related to each other. Let’s 
take the “weather forecast USA” example and assume it consist of two articles and a Dossier. One article is in HTML 
format, and the other in InCopy format. The Dossier is given two object targets: “USA Site” and “USA Magazine”. In 
Content Station the Dossier looks as follows:

![]({{ site.baseurl }}{% link web-services-guide/images/image33.png %}) As we can see, the user has targeted each 
article to a different issue. Now, the Dossier has object targets, but the articles each have a related target. The 
figure below shows how that is tracked in Enterprise’s data model.

![]({{ site.baseurl }}{% link web-services-guide/images/image34.png %})

When the user tags the related targets for the articles, Content Station calls the *UpdateObjectRelation* service. 
For the Dossier-article relation, it passes the targets as shown in the following fragment:

```xml
<UpdateObjectRelations>
	...
	<Relations>
		<Relation>
			<Parent>1461</Parent>
			<Child>1464</Child>
			<Type>Contained</Type>
			...
			<Targets>
				<Target>
					<Issue>
						<Id>89</Id>
						<Name>USA Magazine</Name>
					</Issue>
					<Editions xsi:nil="true"/>
				</Target>
				...

```

Let’s involve a layout in this example. The layout is just targeted to the print issue “USA magazine”. When the article 
is placed on the layout, an object relation is created between both. And again, upon the relation, a new relation target 
build. The following figure shows how this is tracked in the Enterprise model:

![]({{ site.baseurl }}{% link web-services-guide/images/image35.png %})

## Structural change for multiple channels

Since Enterprise 6, various structural changes have been implemented which are mainly about the need to support multiple 
publication channels. This had quite some impact on the workflow WSDL as described below. This paragraph is written for 
those who are migrating from Enterprise 3/4/5 (to 6 or higher).

New insights told that objects are no longer targeted to a Brand (formerly called Publication). The object is owned by 
the Brand, and therefore the *Publication* element needed to move from *TargetMetaData* to *BasicMetaData*.

At Brand level, Issues and Editions could be configured. There was a need to introduce another concept, namely 
Publication Channels. Publication Channels are configured as part of the Brand, and Issues and Editions are configured 
as part of the Publication Channel.

Objects could be assigned to just one Issue at the same time. Also here, another concept was introduced, called a target. 
A target is one Issue with optionally a set of Editions. An object can be ‘targeted’ to many Issues, which is established 
by having multiple targets.

The *TargetMetaData* element could hold one ‘target’ only (which was one Issue with many Editions). To support many, 
a new element named *Targets* was introduced directly under the *Object* element. This move was also done because 
targets can change while objects are locked (while other properties can’t). To visualize this, the targets do no longer 
belong under the *MetaData* element.

The term 'section' is too print oriented and does not cover its intended use. Also, for other channels than print, the 
term 'section' is not appropriate. Therefore it was changed to 'category', not only for the GUI, but for the WSDL as well. 
For channels other than print, the term section did not have much meaning. It is therefore changed to Category, not only 
for the GUI, but for the WSDL as well.

Just like the *Publication* element, the *Section* is nothing like a target anymore. Therefore it is moved to 
*BasicMetaData* element too, and renamed to *Category*.

Although the WSDL structure has been changed, Enterprise 6 and 7 still support requests that are structured the old way 
for backwards compatibility reasons. Nevertheless, this will no longer be done for future versions. Server Plug-in 
developers don’t have to deal with this since the core server does restructure on-the-fly before calling the plug-ins 
for incoming requests, and after outgoing responses. This includes all changes mentioned above. So Server Plug-ins 
should deal with the new structure only, while there could be still old clients talking.

```xml
<Object>
	<MetaData>
		<BasicMetaData>
			...
			<Publication>
				<Id>1</Id>
				<Name>WW News</Name>
			</Publication>
			<Category>
				<Id>1</Id>
				<Name>News</Name>
			</Category>
			...
		</BasicMetaData>
		<TargetMetaData xsi:nil="true" />
		...
	<Targets>
		<Target>
			<Issue>
				<Id>1</Id>
				<Name>2nd issue</Name>
			</Issue>
			<Editions>
				<Edition>
					<Id>1</Id>
					<Name>North</Name>
				</Edition>
				<Edition>
					<Id>2</Id>
					<Name>South</Name>
				</Edition>
			</Editions>
...
```