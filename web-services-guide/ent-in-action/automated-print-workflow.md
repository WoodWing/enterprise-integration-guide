---
layout: chapter
title: Automated Print Workflow [since 9.8]
sortid: 200
permalink: 1043-automated-print-workflow
---

This feature is about Images and Articles contained in a Dossier that can be automatically placed on a Layout without 
the need to open the document in the InDesign client.

To make this happen, text frames and graphic frames on the Layout should be labelled with Element Labels and grouped 
into so-called InDesign Articles.

The feature requires the following minimum versions:

* Enterprise Server 9.8.0
* Smart Connection 10.2.1 for ID/IDS CC2014
* Content Station 9.8.0

### Prepare layouts

When saving a Layout in Smart Connection the InDesign Articles and their frames are communicated to Enterprise Server:

```xml
<SaveObjects>
	<Objects>
		<Object>
			...
			<Relations>
				<Relation>
					...
					<Placements>
						...
			...
			<Placements>
				...
			<InDesignArticles>
				<InDesignArticle>
					<Id>246</Id>
					<NameArticle 1</Name>
				</InDesignArticle>
				...
```

In the *Object* structure there are two places where *Placements* can be found. If a frame contains a text component 
of an Enterprise Article object or a graphic of an Enterprise Image object, it is defined under *Objects-&gt;Relations-&gt;Placements*. 
Or else, when the frame belongs to any of the InDesign Articles of the layout, it is defined under *Object-&gt;Placements*. 
This way, one frame will never be communicated in both places.

### Place dossier

The contents of a Dossier can be placed on a Layout. The user clicks the Create Layout button in the channel view of a 
Dossier and picks a Layout. Content Station requests for the available InDesign Articles for that layout as follows:

```xml
<GetObjects>
	...
	<RequestInfo>
		<String>InDesignArticles</String>
		...
	...
```

Enterprise Server returns the InDesign Articles:

```xml
<GetObjectsResponse>
	<Objects>
		<Object>
			...
			<InDesignArticles>
				<InDesignArticle>
					<Id>246</Id>
					<NameArticle 1</Name>
				</InDesignArticle>
				...
```

The user picks one of the listed InDesign Articles. Content Station can not edit Layouts. Instead, it locks the Layout 
for editing (LockObjects) and indirectly ‘places’ the Dossier on the Layout by creating an Operation for the Layout:

```xml
<CreateObjectOperations>
	<Ticket>...</Ticket>
	<HaveVersion>
		<ID>1178</ID>
		<Version>0.2</Version>
	</HaveVersion>
	<Operations>
		<ObjectOperation>
			<Id>9f7dd5f4-281a-e885-3707-b642faa3c248</Id>
			<Name>PlaceDossier</Name>
			<Type>AutomatedPrintWorkflow</Type>
			<Params>
				<Param>
					<Name> => EditionId
					<Value> => 1
				</Param>
				<Param>
					<Name> => DossierId
					<Value> => 1181
				</Param>
				<Param>
					<Name> => InDesignArticleId
					<Value> => 246
				</Param>
			</Params>
		</ObjectOperation>
	</Operations>
</CreateObjectOperations>
```

Note: Instead of picking a Layout, the user can pick a Layout Template. In that case Content Stations calls the 
*InstantiateTemplate* service instead.

The server queries for any server plug-in connectors that implement this interface:

> *AutomatedPrintWorkflow\_EnterpriseConnector*

For each connector found, it calls the *resolveOperation()* function to let the connector change the Operations 
(when needed) before they are actually stored in the database for the Layout. In this example, the *AutomatedPrintWorkflow* 
plug-in is installed which queries the database and finds out that the Dossier has one Article text component and one 
Image that could be matched with the InDesign Article of the Layout. Therefore it ‘resolves’ the *PlaceDossier* operation 
into two other operations, *PlaceArticleElement* and *PlaceImage*.

```xml
<CreateObjectOperationsResponse>
	...
	<Operations>
		<ObjectOperation>
			<Id>08a8d9e6-236f-57f4-e677-e71ab95e77f6</Id>
			<Name>PlaceArticleElement</Name>
			<Type>AutomatedPrintWorkflow</Type>
			<Params>...</Params>
		</ObjectOperation>
		<ObjectOperation>
			<Id>1cd68eb0-d5d2-6e05-c68a-e88e64fb1c3a</Id>
			<Name>PlaceImage</Name>
			<Type>AutomatedPrintWorkflow</Type>
			<Params>...</Params>
		</ObjectOperation>
	</Operations>
</CreateObjectOperations>
```

After a while, Content Station releases the Layout lock (UnlockObjects) to give way for further processing. When the 
IDS Automation feature is enabled, an *IDS\_AUTOMATION* job is created during the Operation creation. This job gets 
picked up from the queue and is processed in the background. Basically it requests InDesign Server (through SOAP) to 
run a very simple Javascript module (indesignserverjob.jsx). The script requests Smart Connection to LogOn, open and 
save the Layout and LogOff again. This is to let Smart Connection for InDesign Server process the Object Operations 
for the Layout.

After Smart Connection does the LogOn, it also requests (through the admin web services) for any so-called sub-applications:

```xml
<GetSubApplicationsRequest>
	<Ticket>...</Ticket>
	<ClientAppName>InDesign Server</ClientAppName>
</GetSubApplicationsRequest>
```

In this example, the *AutomatedPrintWorkflow* plug-in hooks in the *runAfter()* function of this web service and provides 
a JavaScript module that is provided by a server plug-in:

```xml
<GetSubApplicationsResponse>
	<SubApplications>
		<SubApplication>
			<ID>SmartConnectionScripts_AutomatedPrintWorkflow</ID>
			<Version>1.6</Version>
			<PackageUrl>
				http://127.0.0.1/Enterprise/server/plugins/AutomatedPrintWorkflow/idscripts.zip
			</PackageUrl>
			<DisplayName>Automated Print Workflow</DisplayName>
			<ClientAppName>InDesign Server</ClientAppName>
		</SubApplication>
	</SubApplications>
</GetSubApplicationsResponse>
```

Smart Connection downloads and extracts the package that contains a JavaScript module and loads it into IDS. The 
indesignserverjob.jsx script is still running and continues with opening the Layout. While opening, Smart Connection 
downloads and locks the Layout for editing. It finds the Operations sent along with the Layout (GetObjects) and provides 
those Operations to the JavaScript module. The module uses the information of the Operations to do the actual placing. 
In the example, this is where the Article text components and the Images are placed. The script continues and saves the 
Layout. Smart Connection generates page previews and PDFs (if needed) and creates a new version in Enterprise and 
releases the lock.

When the IDS Automation feature is disabled, the Layout does not get processed directly, but has to wait until someone 
opens the Layout in InDesign client. Then the exact process takes place in InDesign client as described above for 
InDesign Server. It could happen that many operations are created before the Layout gets opened. That slows down opening 
the Layout since all those operations needs to be processed. For this performance reason it is recommended to enable 
the IDS Automation feature when the Automated Print Workflow feature is enabled.

### Customizations

As you may have noticed in the previous paragraph, the Automated Print Workflow feature is built into a server plug-in. 
While Enterprise introduces a mechanism to build such a feature, it also provides the *AutomatedPrintWorkflow* plug-in 
that implements the default behaviour (business logics) and does place operations.

Basically, all you need is a server plug-in that provides a server module and client module. The server module queries 
the text components and images in the database and the client module places them in the InDesign Article frames.

This allows you to:

* Disable the *AutomatedPrintWorkflow* plug-in and build your own solution with different or customer specific business 
logics that determines which text component or image should be placed on which InDesign Article frame.
* Add another plug-in that introduces more operations. See also *example on Labs*.

### Default behaviour

The *AutomatedPrintWorkflow* plug-in implements the default behaviour. It works when Element Labels are unique within 
each InDesign Article (e.g. there should be one head, intro, body and graphic) and unique within Dossiers. It has the 
following reasoning:

1. Resolve the Layout frames that belong to the selected InDesign Article.
1. Exclude duplicate InDesign Article frames; Those can not be uniquely matched.
1. Collect frame types (graphic or text) from the resolved InDesign Article frames.
1. Determine object types (Article, Image) that are compatible with the frame types.
1. Take the Issue to which the Layout is assigned to and take the Edition from the InDesign Article frame.
1. Search in the Dossier for Articles and Images that are assigned to the same Issue and Edition via the Dossier (relational targets).
   1. Exclude Articles and Images for which the user has no read access rights.
   1. Exclude Articles and Images in Personal status and routed to another user.
1. Exclude Articles that are placed already and the user has no Allow Multiple Article Placements access rights.
1. For each candidate Article:
   1. Resolve the Layout frames (placements) of the found Article.
   1. Exclude frames with duplicate element label; Those can not be uniquely matched.
   1. Exclude graphic frames; This is not supported by Smart Connection.
   1. Exclude frame when the same frame label also exists in the same or other Article.
   1. Match the frame element labels with the InDesign Article frame element labels.
1. For each candidate Image:
   1. Only make a match when InDesign Article has one graphic frame and exactly one Image was found in the Dossier.
1. For each match that could be made, add new Object Operations to the Layout.
1. For each frame that could not be matched, add the *ClearFrameContent* operation.
