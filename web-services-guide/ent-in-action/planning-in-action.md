---
layout: chapter
title: Planning in Action
sortid: 010
permalink: doc1040
---

Planning is an optional feature which is taken care of by a third-party plan system integrated in Enterprise. Which plan 
system to integrate is the customer’s choice. Examples are Journal Designer (DataPlan) and Timone (Tell). Planning 
integrations are typically established through the planning interface, but in some cases with extra help of the workflow 
interface.

Planning integrations allow planners to synchronize their issue plans to the production system. Customers can work in 
two different way, both of which are supported:

* **Throw the plan over the fence** - Some customers like to create a full plan, synchronize it, continue in production, 
and no longer care about the plan. At this point, the planning system could shut down and progress is monitored in 
production (using the Publication Overview). This is the most simple form, wherein production takes over the lead.
* **Continuous synchronization** - Some customers have a dedicated planner who takes the lead from creation till the 
planned issue gets finally printed. Plans are continuously synchronized with production while many editors and layout 
designers are producing pages. The idea is that the planner is the boss and so plans should be respected in production. 
For example, layout designers in production are bound to the planned pages and their numbering, but they have full 
control over the placed objects. Placed adverts are the only exception in this and are created by the planner. Advert 
positions on pages are important since ads have different prices depending on their positions. Layout designers have to 
respect that, but still have some freedom to make them fit onto the page nicely.

## Page planning

Pages are used within a print-oriented workflow. Pages can be planned, produced and printed. In this context, Enterprise 
does the production, and third-party systems do the planning and printing.

![]({{ site.baseurl }}{% link web-services-guide/images/image36.png %})

While the planner is creating pages in the plan system, planned pages also get created within the Enterprise database 
through the planning interface. This is done by creating layout objects from layout templates, which reside in the 
Enterprise database. The template pages are replicated for the layout for as many pages that are planned (by the planner).

The following figure shows a planner with four pages planned \[1\]. The third-party planning tool picks up those pages 
and synchronizes \[2\] the four pages into the Enterprise system through the planning interface. The Enterprise Server 
retrieves \[3\] the requested layout template and creates a new layout \[4\] from it.

![]({{ site.baseurl }}{% link web-services-guide/images/image37.png %})

At this point, a layout is created in Enterprise database with four planned pages. The InstanceType (as defined at 
workflow WSDL) is set to ‘Planning’ for these pages. Also, a message is sent to the layout and a flag is set. The flag 
indicates that the attention of the layout designer is needed; the message informs the layout designer about the creations 
(or changes) made to the planned layout.

Once pages are planned, the production can pick them up. The layout designer finds the flagged layouts that were planned 
at his/her query results. (To see the flags, special query columns must be configured; for more information, see the 
Admin Guide.) At this point, the binary layout file itself is a rough copy (made by the server) of the layout template. 
Once the layout designer opens it, this file is sent from the server to the InDesign client, along with the planned(!) 
pages. Once opened in InDesign, the Smart Catalog plug-ins are able to create concrete pages (for production) based on 
the arrived planned pages and update the binary file. Before doing so, a dialog is raised to ask the layout designer 
whether or not to do this automatically. The layout designer can cancel this and do it manually. When the message is 
confirmed though, it is done automatically by the plug-ins. This includes the following operations:

Pages are added or removed, because the template could have less or more pages than the layout requires. New pages are 
based on the master page, as indicated by the planner.

Pages are renumbered, to reflect the Issue planning. Template pages typically start with page 1, but layout pages could 
start with any number, depending on their position in the planning.

Adverts are placed on pages. For more details, see *advert planning*.

Let’s recap the step wherein planned pages are taken into production (see the figure below). First, the layout designer 
opens a layout \[1\] and the plug-ins request it to get \[2\] it from the database. The planned pages (orange) are 
synchronized \[3\] into production by the plug-ins. The produced pages (red) are saved \[4\] on the layout designer’s 
command and stored \[5\] in the database.

![]({{ site.baseurl }}{% link web-services-guide/images/image38.png %})

Now there are two sets of pages: planned and produced. The produced pages have the InstanceType (as defined at workflow
 WSDL) set to ‘Production’.
