---
layout: chapter
title: Objects and Metadata
sortid: 010
permalink: 1056-objects-and-metadata
---
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
- *TargetMetaData* - Obsoleted since Enterprise Server 6.0. Use Object -&gt; Targets instead. See *Structural change for multiple 
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

\[Since 7.0\] Since Enterprise Server 7.0 users can create an object (let’s say a new article), whereby he/she is offered to 
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