---
layout: chapter
title: Layouts and Placements
sortid: 020
permalink: 1057-layouts-and-placements
---

## Layouts and pages

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

![]({{ site.baseurl }}{% link web-services-guide/images/image20.png %})

Notice that the page *sequence* is now ‘restarted’ per layout object.

With pages split-up into layouts, they are no longer strictly bound to each other. This enables the server to put them 
in the Publication Overview with more intelligence. When creating a new layout (for example containing pages p6 and p7) 
this automatically gets inserted into the overview, without the need to open and edit “layout 2”.

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
