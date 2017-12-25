---
layout: chapter
title: Workflow Entities
sortid: 010
permalink: doc1038
---
## Objects

Enterprise manages workflow objects. The way objects are treated strongly depends on the object type. For example, an 
article is an Object for which the type is set to Article. By knowing the type, specific business rules are triggered, 
such as whether an object is placeable, if it can be placed multiple times, on which other object type it can be placed, 
etc. Once an object is created, its type can never change.

The complete list of supported types can be found in the WSDL in the ObjectType definition. One of them is the Other 
type, which is especially useful for system integrators introducing foreign object types that do not look like any of 
the standard supported types and need no special treatment by Enterprise itself. For example, custom Server Plug-ins 
(or SOAP clients) could check for this type and do something fancy with the object, such as unzipping a ZIP file and 
dynamically create objects from the files found inside.

## Formats

Note that different formats (technical types) are supported per object type. For example for Article objects, the 
following formats are commonly used: InCopy, plain text, RTF, Word and Excel. For formats, MIME content types are used 
(see http://www.w3.org/Protocols/rfc1341/4\_Content-Type.html). Common format types used in Enterprise are:

- application/incopy
- application/indesign
- image/jpeg
- image/tiff
- application/pdf
- application/postscript
- application/msword
- application/rtf
- text/richtext
- text/plain

## Object IDs

Each object has an ID to uniquely identify the object within the Enterprise system. The object ID is typically numeric, 
but it can also be any string (which is sometimes done by (Content Source) integrations such as Fotoware). Strings are 
allowed, as long they can be used as a folder name on Mac OSX and Windows, which is required by Enterprise clients.

## Status

An object is always in exactly one workflow status at the same time. This tells which workflow definition the object 
is following. The workflow is set up through the Brand Maintenance admin pages (see the Admin Guide for details.) 
A status depends on the object type; when there is no status configured for an article object, articles cannot be created. 
A status has an ID which is unique within the whole system. Personal statuses have the ID set to -1 (regardless of the 
user or object type). Those special statuses are recognized by the system and treated differently; they are not stored 
in the database (unlike normal statuses) and are created on-the-fly which makes users think they truly exist. A status 
has a localized name and a color configured, which both have no meaning for the system at all. A sequence number is 
used to order statuses shown in lists.

## Object properties

Along with each object, metadata is stored. It consists of a pre-defined set of properties to which custom properties 
can be added. Metadata is structured differently depending on the context of usage, as explained in the following paragraphs.

### Metadata services

When end users are retrieving, creating or saving objects (or setting properties), metadata properties are put in a 
hierarchical tree. This tree structure can also hold entities, such as a status which contains the id, name, etc. 
(see fragment below). The entity data is assumed to be read-only when passed along with objects. Typically it is the 
server returning such data for client convenience. All of this gets ignored when it is passed back by the clients to 
the server, except for the id. Ids are referring to entity instances stored in the database, so when the ids are changed 
during an object save operation (SaveObjects), the server will update references made from the object to the entity 
instances stored in the database.

```xml
<Object>
	<MetaData>
		...
		<WorkflowMetaData>
			...
			<State>
				<Id>257</Id>
				<Name>For Review</Name>
				<Type>Article</Type>
				<Produce xsi:nil="true"/>
				<Color>#666633</Color>
				<DefaultRouteTo xsi:nil="true"/>
			</State>
			...
		</WorkflowMetaData>
		...
	</MetaData>
</Object>
```

The format of properties and entities (such as the *State*) can be looked up in the WSDL (see the fragment below). 
For example, the status name is a *string*.

```xml
<complexType name="State">
	<all>
		<element name="Id" type="xsd:string"/>
		<element name="Name" type="xsd:string"/>
		<element name="Type" type="tns:ObjectType"/>
		<element name="Produce" nillable="true" type="xsd:boolean">
		<element name="Color" nillable="true" type="tns:Color"/>
		<element name="DefaultRouteTo" nillable="true" type="xsd:string"/>
	</all>
</complexType>
```

Custom properties are sent in list format (through MetaData -&gt; ExtraMetaData) as shown in the fragment below. 
Their names are prefixed with “C\_”. Regardless of the configured data type, the current value(s) is always a list of strings.

```xml
<Object>
	<MetaData>
		...
		<ExtraMetaData>
			<ExtraMetaData>
				<Property>C_IS_MY_HAIR_OK</Property>
				<Values>
					<String>No</String>
				</Values>
			</ExtraMetaData>
			...
		</ExtraMetaData>
	</MetaData>
</Object>
```

### Query services

When users perform a search query, the properties are returned in rows and columns. Such properties (sent through 
QueryObjects and NamedQuery services) are formatted using the very same structure elements (such as *Property* and *Row*). 
For entity elements the element name itself represents the name. Its elements are concatenated. For example, the status 
name is *State* and the status id is *StateId*, as shown in the following fragment:

```xml
<QueryObjectsResponse>
	<Columns>
		...
		<Property>
			<Name>State</Name>
			<DisplayName>Status</DisplayName>
			<Type>list</Type>
		</Property>
		<Property>
			<Name>StateId</Name>
			<DisplayName>Status ID</DisplayName>
			<Type>string</Type>
		</Property>
		...
	</Columns>
	<Rows>
		<Row>
			...
			<String>For Review</String>
			<String>257</String>
			...
		</Row>
		...
	</Rows>
</QueryObjectsResponse>
```
It shows that (at least) two columns are returned; the status name and the status id. There is also (at least) one row 
returned, which contains the actual data. Which columns are included depends on the configuration made in the 
“Query Result Columns” of the Dialog Setup admin page (for QueryObjects service) or the definition of the Named Query 
(for NamedQuery service). See the Admin Guide for configuration details.

For a full list of property names, look in the server/bizclasses/BizProperty.class.php file.

### Dialog services

Whenever a client application raises a workflow dialog, it requests the dialog definition (through GetDialog service). 
The actual object properties are included as well (in GetDialog -&gt; MetaData) to be displayed in the dialog. 
The properties are flattened to the very same structure elements (MetaDataValue). This is done for client application 
convenience. For example, when the Status property is configured to show in the dialog, and the object is currently 
in the “For Review” status (id=257), the returned structure looks like the following fragment:

```xml
<GetDialogResponse>
	<Dialog>
		...
		<MetaData>
			...
			<MetaDataValue>
				<Property>State</Property>
				<Values>
					<String>257</String>
				</Values>
			</MetaDataValue>
			...
		</MetaData>
		...
	</Dialog>
</GetDialogResponse>

```

You might wonder why the name of the status id property is not named *StateId*, but just *State*. This is because from
 an admin user point of view (configuring dialogs) the status name should be shown. But, in the dialog, the end user is 
 selecting a status from the list, which results in an id. To make references correctly within this service response, 
 the *State* property is used to represent the status id.

See *Workflow services* for a detailed service explanation.

## Object metadata

As mentioned in the previous paragraph, object properties can be structured in a hierarchical tree. The advantage is 
that the structure is organized, humanly readable and the data types are pre-defined for all built-in properties. This 
is done by using the *MetaData* definition in the workflow WSDL. It consists of the following main structure parts with 
different purposes:

- *BasicMetaData* - Identifies the object and tells how it is bound to the Brand and workflow. For new objects, there 
is no id, and so name, type and Brand (publication) are needed.
- *TargetMetaData* - Obsoleted since Enterprise 6. Use Object -&gt; Targets instead. See *Structural change for multiple 
channels* for more information.
- *RightsMetaData* - Copyright information.
- *SourceMetaData* - Credit information.
- *ContentMetaData* - Properties closely related to the native content file. Which properties are filled differs per 
object type or file format. These properties are versioned.
- *WorkflowMetaData* - Tells how the object is currently doing in the workflow. Who created it, who is working on it, 
what the progress status is, what deadlines should be met, etc.
- *ExtraMetaData* - Used to carry custom properties along with the object. Since these properties are configurable, 
there is no type checking done through the WSDL.

## Object renditions

Per individual object, Enterprise can store multiple files, called renditions. Typically objects have a native rendition 
and possibly preview, thumbnail and output renditions. The WSDL identifies the following renditions:

- none - no rendition, used for example to get an object's properties without any of its files.
- thumb - optimized for thumbnail overviews, typically JPEG of approximately 100 pixels wide.
- preview - optimized for preview purposes, typically JPEG of approximately 600 pixels wide.
- placement - abstract rendition, requested by InDesign when an image is placed. The Enterprise Server returns the 
rendition with the highest quality, preferably native.
- native - primary rendition used for editing, for example a PSD file for an image.
- output - export rendition, typically PDF or EPS for the pages of a layout object.
- trailer - preview rendition for audio/video.

## Layout pages

Enterprise stores InDesign files (layouts). With a layout, layout template, Layout Module or Layout Module template, 
pages are stored. These layout flavors are objects, but note that the pages themselves are not treated as objects. 
Whenever the term *layout* is used in the paragraph, it refers to any of the layout flavors.

## Page renditions

Pages have renditions, just like objects have. And so, a thumb, preview and output rendition file can be stored per page. 
The output rendition is typically PDF or EPS.

![]({{ site.baseurl }}{% link web-services-guide/images/image18.png %})

Note: Page rendition files are not versioned; only the last version of each rendition is tracked. When restoring an old 
version of a layout without InDesign intervention, the page renditions remain untouched. As a result, the version that 
is ‘too new’ is still shown in the Publication Overview.

### Page numbers

Per page, the following is tracked: order, number and sequence. The *order* stands for the logical internal numeric 
position, as used by InDesign internally. Per page section, you can restart this numbering. Although you choose a 
numbering system (alphanumeric, roman, arabic, etc), the order is always numeric. The page *number* is the human 
readable representation. This reflects the page numbering system and optionally can be prefixed with the page section 
prefix. The number is typically used to print on the page. The page *sequence* represents the page position within the 
layout. This is used to uniquely identify pages since the page order does not tell, as shown in the following figure.

![]({{ site.baseurl }}{% link web-services-guide/images/image19.png %})

It shows a layout with 7 pages divided into 3 page sections. Each section uses a different numbering system, respectively 
roman, arabic and alphanumeric. The second section has continued numbering and defines prefixes. The third section has 
restarted numbering.

### Splitting up pages

The example above could work for small documents such as brochures. For large documents, such as magazines and books, 
splitting up pages into multiple layouts is recommended. Let’s split-up the pages in three layout objects, exactly the 
way it is split-up by page sections. You will end up with 3 layouts, each having one page section, as shown in the 
following figure.

![](images/image20.png)

Notice that the page *sequence* is now ‘restarted’ per layout object.

With pages split-up into layouts, they are no longer strictly bound to each other. This enables the server to put them 
in the Publication Overview with more intelligence. When creating a new layout (for example containing pages p6 and p7) 
this automatically gets inserted into the overview, without the need to open and edit “layout 2”.

## Object relations

Objects can be related to each other in several ways. For example, an article can be placed onto a layout. In this 
case we speak of a ‘Placed’ relation type of which the layout is the parent and the article is the child. Another 
example is an image that is put into a Dossier. In this case, we speak of a ‘Contained’ relation type with Dossier as 
parent and image as child. Most relations are parent-child relations which implies that they can be represented 
hierarchically in the search results. The complete list of supported relation types can be found in the *RelationType* 
element of the workflow WSDL file.

The ‘Related’ type is used for Dossiers that are related to each other. Unlike the hierarchical relations, this is a 
brother-sister relation which are therefore not shown in the search results.

Client applications typically inform the server explicitly which relations to make (or remove). The following workflow 
services can be used to manage object relations:

- CreateObjectRelations
- UpdateObjectRelations
- DeletetObjectRelations
- GetObjectRelations

\[Since 7.0\] Since Enterprise 7 users can create an object (let’s say a new article), whereby he/she is offered to 
select the “Create Dossier” item of the Dossier property in the workflow dialog. Therefore, the object creation service 
(CreateObjects) supports implicit Dossier creation. This is simply done by sending a fictitious relation to the Dossier 
through this service. This triggers the server to create a new Dossier before creating the article. With both objects 
available, the server then creates a ‘Contained’ relation between them. Since the parent Dossier object is not created 
at the time when the service is called, there is no id and so -1 should be specified. The fragment below shows how 
this is done.

```xml
<CreateObjects>
	<Objects>
		<Object>
			...
			<Relations>
				<Relation>
					<Parent>-1</Parent>
					<Child xsi:nil="true"/>
					<Type>Contained</Type>
					...

```

## Placements and Elements

With InDesign, articles and images are placed on layouts by using frames. Frames can either be textual or graphical. 
From a multiple frame selection, an article can be created. Images are created from a single frame. Each frame has 
geometrical information and is stored into Enterprise as a *Placement* (whenever an object is made from it).

Consider a placed article shown on the left in the figure below. It consist of five frames; one *head* frame, one *intro* 
frame and three *body* frames. The three *body* frames are linked for continuous reading. The figure in the middle shows 
how InDesign frames become Enterprise placements. Multiple frames that are linked are seen as just one story, just like 
single frames. A story is called *Element* in Enterprise (or Component for the end user). In the example, the three *body* 
frames become one *Element*. So the article consists of three elements/components; *head*, *intro* and *body*, as shown 
on the right.

![]({{ site.baseurl }}{% link web-services-guide/images/image21.png %}) ![]({{ site.baseurl }}{% link web-services-guide/images/image22.png %}) ![]({{ site.baseurl }}{% link web-services-guide/images/image23.png %})

Assume that the article is placed on the layout. The create and save requests (CreateObjects and SaveObjects) will 
carry out the elements and placements to the server.

For **layout** create/save operations in Objects -&gt; Object -&gt; Placements element, the structure is shown in the 
fragment below. The *ElementID* for the body placements is the same. This way, the placements are bundled per element. 
The *FrameOrder* tells the reading sequence of the placements.

```xml
...
<Placements>
	<Placement>
		<Page>1</Page>
		<Element>head</Element>
		<ElementID>CAA9DCF6-4F67-43AE-B9E0-1E01DBA40CC4</ElementID>
		<FrameOrder>0</FrameOrder>
		...
	<Placement>
		<Page>1</Page>
		<Element>intro</Element>
		<ElementID>D65C0A5F-8E0B-4456-985A-ECC03BDAE6C4</ElementID>
		<FrameOrder>0</FrameOrder>
		...
	<Placement>
		<Page>1</Page>
		<Element>body</Element>
		<ElementID>23383EBF-4740-4481-AF76-C7410744A094</ElementID>
		<FrameOrder>0</FrameOrder>
		...
	<Placement>
		<Page>1</Page>
		<Element>body</Element>
		<ElementID>23383EBF-4740-4481-AF76-C7410744A094</ElementID>
		<FrameOrder>1</FrameOrder>
		...
	<Placement>
		<Page>1</Page>
		<Element>body</Element>
		<ElementID>23383EBF-4740-4481-AF76-C7410744A094</ElementID>
		<FrameOrder>2</FrameOrder>
		...
</Placements>
...
```

For **article** create/save operations in Objects -&gt; Object -&gt; Placements element, the structure is shown in the 
fragment below. It lists the three elements.

```xml
...
<Elements>
	<Element>
		<ID>CAA9DCF6-4F67-43AE-B9E0-1E01DBA40CC4</ID>
		<Name>head</Name>
		...
	<Element>
		<ID>D65C0A5F-8E0B-4456-985A-ECC03BDAE6C4</ID>
		<Name>intro</Name>
	...
	<Element>
		<ID>23383EBF-4740-4481-AF76-C7410744A094</ID>
		<Name>body</Name>
		...
</Elements>
...
```

\[Since 9.4\] When two articles would share the same Element IDs (GUIDs), placing these articles together on the same 
layout could lead in content loss. Therefore, if a client other than InDesign, InCopy or InDesignServer calls the 
CreateObjects service (with Lock=*false*) for a WCML article, Enterprise Server generates new Element IDs (GUIDs) and 
updates the Elements and the article WCML before saving it in the database and filestore.

### Articles and graphics

Articles can consist of a mix of text frames and graphic frames. The figure below shows an article with one graphic 
frame and two text frames, as shown on the left. In the middle, it shows there is just one object involved, which is the article. On the right, it shows that there are three elements.

![]({{ site.baseurl }}{% link web-services-guide/images/image24.png %})  ![]({{ site.baseurl }}{% link web-services-guide/images/image25.png %})  ![]({{ site.baseurl }}{% link web-services-guide/images/image26.png %})

The very same example could be made differently. The figure below shows a graphics frame that holds a placed image object. 
(Note the little chain icon on the left of the butterfly, which is shown instead of the little pencil icon on top.) 
The two text frames belong to the article object, as shown in the middle. Also here, there are three elements involved, 
as shown on the right.

![]({{ site.baseurl }}{% link web-services-guide/images/image27.png %})   ![]({{ site.baseurl }}{% link web-services-guide/images/image28.png %})  ![]({{ site.baseurl }}{% link web-services-guide/images/image26.png %})

### Placements and Editions

Placed objects (such as articles and images) can be assigned an Edition on the layout. InDesign allows users to set 
Editions per story element (changing one frame affects all frames that belong to the same element). Nevertheless, 
Editions are tracked by Enterprise at a more granular level, which is per placement.

An example. Imagine you have written a manual about your InDesign CS3 plug-in. Then CS4 comes out, but you are still 
doing heavy maintenance to the document and update your readers on a regular basis. Actually, the CS4 update doesn’t 
have much impact to your document. It affects just some articles and the InDesign logo that is used in several places. 
Obviously, you would like to share as much as possible between the two manuals and publish both simultaneously. This 
is where editioning could help. By simply placing the CS3 and CS4 logo in the same InDesign layout, and tagging CS3 
Edition for one and CS4 Edition for the other. The figure on the right shows how the result could look like in InDesign.

CS3 | CS4
---|---
![]({{ site.baseurl }}{% link web-services-guide/images/image29.png %}) | ![]({{ site.baseurl }}{% link web-services-guide/images/image30.png %}) 

When saving the layout, the request from InDesign (SaveObjects) looks like the fragment shown below. because there are 
three objects related, there are three *Related* elements. They are all on the same page and share the same parent. 
For the images, a specific Edition is specified. The article is published for both Editions, and so nil is given, 
which means all Editions.

Note that adding CS5 and CS6 Editions later (in the Maintenance pages), this article will still get published for 
those future Editions. But there won’t be any logos available yet, which must be created and placed on the layout at 
that time, just as it was done in this example for CS4.

```xml
...
<Relations>
	<Relation>                      <!-- CS3 logo -->
		<Parent>1710</Parent>
		<Child>1711</Child>
		<Type>Placed</Type>
		<Placements>
			<Placement>
				<Page>1</Page>
				<Element>graphic</Element>
				...
				<Edition>
					<Id>1</Id>
					<Name>CS3</Name>
				</Edition>
				...
	<Relation>                       <!-- CS4 logo -->
		<Parent>1710</Parent>
		<Child>1712</Child>
		<Type>Placed</Type>
		<Placements>
			<Placement>
				<Page>1</Page>
				<Element>graphic</Element>
				...
				<Edition>
					<Id>2</Id>
					<Name>CS4</Name>
				</Edition>
				...
	<Relation>                       <!-- article -->
		<Parent>1710</Parent>
		<Child>1713</Child>
		<Type>Placed</Type>
		<Placements>
			<Placement>
				<Page>1</Page>
				<Element>body</Element>
				...
				<Edition xsi:nil="true"/>
				...
```

## Targets

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