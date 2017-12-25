---
layout: chapter
title: Preview & Copyfit
sortid: 040
permalink: doc1049
---

## Preview & Copy-Fit \[since 7.4\]

Content Station ships an editor that supports multi-channel editing of articles in WCML format. Enterprise Server offers 
web services Content Station can talk to. A workspace folder can be created at server side to temporary store the article 
and the layouts it is placed into. Having that in place, previews, PDFs and copy-fit information can be requested. At the 
back-end, the server integrates Smart Connection for InDesign Server to do the actual previewing, PDF generation and 
copy-fit calculation for the article being edit.

The following features are in place:
* Write-To-Fit, Preview and PDF of placed articles.
* Write-To-Fit, Preview and PDF of articles derived from article templates. The template must be created from a layout 
to inherit geometrical information.
* Save article at workspace.
  * Does not create a version in the database.
  * Also needed for Auto Save feature.
* New article vs existing article.
  * New articles are not stored in database yet, but can be edited (but not previewed).
* Creating article from template.
* Word/Char/Para counts (done client side only).

Preview optimizations \[since 7.4\]:
* Only preview pages on which article is placed.
* Only retrieve the current page.

Preview optimizations \[since 9.5\]:
* Save and keep layout in workspace. Reuse layout for succeeding requests.
* Save changed article components separately in workspace for fast loading by SC.
* Generate previews and copy-fit for changed text components only.
* SC for IDS no longer retrieves the brand setup through logon response.
* CS editor updates internal versions (GUIDs) of changed stories only.
* CS editor and File Transfer Server use the Deflate compression technique to compress WCML articles while transferring 
them to or from remote locations.

The following services are added to the workflow interface (SCEnterprise.wsdl):

```
CreateArticleWorkspace
	Ticket
	ID (nil for new articles)
	Format (‘application/incopyicml’, used for file extension, and for text conversion?)
	Content (embedded XML, taken from article template)
CreateArticleWorkspaceResponse
	WorkspaceId
```

Since Enterprise 9.5, when the ID parameter is provided, the Content parameter can be set to nil. In that case, the 
latest version of the article is retrieved by Enterprise Server and put into the workspace folder. This saves time for 
remote workers and/or large articles.

``` 
ListArticleWorkspaces (used for recovery only)
	Ticket
ListArticleWorkspacesResponse
	Workspaces
		WorkspaceId
		WorkspaceId
```

``` 
GetArticleFromWorkspace (used for recovery only)
	Ticket
	WorkspaceId
GetArticleFromWorkspaceResponse
	ID (nil for new articles)
	Format
	Content (embedded XML)
```

``` 
SaveArticleInWorkspace (used for auto-save only)
	Ticket
	WorkspaceId
	ID (nil for new articles)
	Format (‘application/incopyicml’, used for file extension, and for text conversion?)
	Elements (dirty frames only, nil when Content is used instead)
		Element
			Content (embedded XML, of one frame only)
	Content (embedded XML, used after adding/removing text components)
SaveArticleInWorkspaceResponse
	[empty]
```

``` 
PreviewArticleAtWorkspace (does implicit save at workspace)
	Ticket
	WorkspaceId
	ID (nil for new articles)
	Format (‘application/incopyicml’, used for file extension, and for text conversion?)
	Elements (dirty frames only, nil when Content is used instead)
		Element
			Content (embedded XML, of one frame only)
	Content (embedded XML, used after adding/removing text components)
	Action (Compose/Preview/PDF)
	LayoutId
	EditionId
PreviewArticleAtWorkspaceResponse (Preview/PDF do Compose implicitly)
	Placements
		Placement (copyfit info)
	Elements
		Element (word/char/para/line counts)
	Pages (nil on Compose)
		Page
			Files
				File
					FileUrl (taken from v8)
					L> http://.../previewindex.php?ticket=12&
					workspaceid=34&action=preview&pageseq=1&
					layoutid=56&editionid=78&articleid=90
	LayoutVersion (as used, can be auto updated server side)
```

``` 
DeleteArticleWorkspace
	WorkspaceId
DeleteArticleWorkspaceResponse
	[empty]
```

## Spread Preview \[since 7.6\]

In the Multi-Channel Text Editor of Content Station, the user can toggle between single page and Spread Preview mode. 
In single page preview mode, the preview pane of the editor displays all pages that contain (a part of) the article only. 
In Spread Preview mode, when an article is placed on one page of a spread (but not on the sibling page) the sibling page 
is included too, just to ‘complete’ the spread view.

Related to this feature, when an article text frame runs over two pages of a spread, it should be visualized on -both- 
pages with a gray box in the preview pane. (Before, only one of the two pages showed the gray box.)

In this chapter, the following terms are used:

Term            | Meaning
---------------:|----------------
spread          | Left and right page together (as shown in InDesign).
sibling page    | The other page of the spread. Talking about the left page, the right page is the sibling page, or vice versa.
placement tile  | Part of a placement. When placement (text frame) runs over two pages of a spread, it gets ‘divided’ 
into two tiles; One tile that fits on the left page and one tile that fits on the right page. Both tiles glued together 
has the same shape/dimensions as the placement itself.

When an article text frame (from now called ‘placement’) is placed on one page of the spread, but also partly covers 
the sibling page, the placement is enriched with two 'tiles'. As long as a placement fits on its page, there are no tiles. 
When one placement covers two pages, there are two tiles, each with coordinates and dimensions relative to the corresponding 
page. For a tile, Enterprise keeps track of placement db id, page sequence nr, left, top, width and height.

A PlacementTile is new workflow data type added to the SCEnterprise.wsdl. The Placement element has a new property named 
Tiles, which is a list of PlacementTile elements.

When a layout is stored (through CreateObjects / SaveObjects services), the Smart Connection plug-ins for InDesign send 
tile info along with the page placements. This happens only when necessarily; when the placement fits on the page, no 
tiles are provided. Enterprise Server stores the tiles in the database in a new table, named smart\_placementtiles.

When the layout and article are stored at the server, the Multi-Channel Text Editor of Content Station can request a 
preview through the PreviewArticleAtWorkspace service. This service has a new parameter named PreviewType, which can be 
either ‘page’ or ‘spread’. In single page preview mode, Content Station sends ‘page’ and in Spread Preview mode, it 
sends ‘spread’.

When it comes to preview generation, Enterprise Server calls InDesign Server through SOAP, and feeds its JavaScript 
module named IDPreview.js (which can be found in the server/apps folder). That module talks through scripting API to 
InDesign Server and Smart Connection plug-ins. This integration is responsible for returning previews of pages containing 
article content. Results are written in the composedata.xml file in the user’s workspace folder (server side) along with 
the generated preview files. So far, nothing new.

If an article placement is placed on a spread (for example: one text frame on pages 2 and 3) and the new PreviewType 
parameter is set to ‘spread’, IDPreview.js returns previews of -both- pages (one that contains the article, and one that 
does not).

When a placement has tiles, Smart Connection plug-ins provide Tiles information through the frameData JSON. This info is 
read by IDPreview.js and is written to the composedata.xml. Therefore, the XML structure is expanded with a &lt;tiles&gt; 
element that may occur inside a &lt;textframe&gt; element. Inside, a list of &lt;tile&gt; elements provides info about 
the dimension of each placement tile.

Enterprise Server (more precisely: the previewArticleAtWorkspace function of BizWebEditWorkspace class) parses the 
composedata.xml file and composes the Tiles structure returned through the PreviewArticleAtWorkspace service response.

Content Station now displays the Spread Preview. The logics behind placing pages left or right are implemented in 
Content Station. This depends on the reading order. Therefore, the ReversedRead property is introduced in the 
PublicationInfo and IssueInfo elements in the workflow WSDL (SCEnterprise.wsdl). This reading order info is returned 
through the LogOn response.

For the Publication Overview in Content Station, the placement tiles are also important. Without tiles, Content Station 
won’t know if a text frame of an article runs over the other page of the spread (or not). Therefore, Enterprise Server 
returns extra PlacementInfo elements through the GetPages service (as called by Content Station for the Publication Overview). 
For each placement, but now also for each placement tile, a PlacementInfo exists.

When a layout is sent to the Trash Can, the tiles remain in the database (in the smart\_placementtiles table) so that the 
tiles are available again when the layout is restored. When a layout is removed permanently (purged), the tiles are 
removed from the database.
