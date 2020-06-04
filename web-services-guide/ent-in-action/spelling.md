---
layout: chapter
title: Spelling
sortid: 130
permalink: 1050-spelling
---
## Spelling \[since 7.4\]

> Note that Spelling and Suggestions services are deprecated since Studio Server 10.11.

The Multi-Channel Text Editor of Content Station 7.4 includes support for spelling checking. This feature runs through 
new web services exposed by Enterprise Server 7.4. This feature is about having a consistent spelling checking throughout 
the whole workflow. For example, once an article is spell-checked by an editor, he/she puts the article in the next status, 
indicating the article is ready for publishing. When at that stage the article shows five errors, no matter on which 
machine or on which editor the article gets opened, it should still show these (and only these) same five errors.

Customers are free to choose their favorite spelling engine. Most commonly used engines are integrated and provided as 
demo server plug-ins. Integrators are able to build their own integration with other engines. For that, a new business 
connector interface is added to integrate spelling engines:

`Enterprise/server/interfaces/plugins/connectors/Spelling_EnterpriseConnector.class.php`

The supported spelling languages depend on the availability of the dictionaries for the chosen spelling engine. 
Enterprise should not stand in the way at this point and let system admins freely configure any (or many) of those 
languages.

Since the new configuration is much more advanced, the article’s text might be split into words differently (as a 
pre-processing step for spelling). As a result, there could be unneeded spelling errors for those two editors. 
This is a known limitation.

Note that also InCopy and InDesign do *not* use the Spelling and Suggestions features as offered by Enterprise Server. 
Instead, they use their own spelling features as built-in by Adobe. This could lead to spelling differences between the 
editors.

Configurations applied to the ENTERPRISE\_SPELLING option are returned through the LogOnResponse to Content Station. 
See the Admin Guide for installation and configuration of spelling integrations.

New services are added to the workflow WSDL: CheckSpelling, GetSuggestions and CheckSpellingAndSuggest.
