# WoodWing Software - Enterprise Web Services Guide
<span style="color:red">EXPERIMENTAL VERSION</span>

## Introduction
Before Enterprise 7, a System Integration Guide was available for Enterprise 4. That document has now been discontinued in its current form and split up into two components:
* **Web Services Guide** (this document). This guide provides in-depth information about how client applications interact with the Enterprise Server system through Web Services. It looks from the ‘outside’ to Enterprise Server and explains concepts, interfaces, operations, data structures, etc.
* **Server Plug-ins.** This is not a guide but a bundle of presentations, practices and examples, explaining how to develop plug-ins. It looks from the ‘inside’ of Enterprise Server and describes the concept of plug-ins and how to customize behavior of Web Services and business logic. 

The Web Services Guide intends not to be complete but to give a good starting point for integrating systems with Enterprise. The explained concepts provide basic ideas and behavior which are concealed underneath Enterprise’s abstract entities. This theory is frequently diversified by concrete examples to visualize how things actually work.
This guide can be used for Enterprise 5 or higher. In some places, it refers to the Server Plug-ins technology, for which Enterprise 6 (or higher) is required.

## Required knowledge
We assume the reader of this guide is familiar with:
* The functionality of the Enterprise system. For more information, check the Smart Connection User Guide.
* The configuration of  the Enterprise system. For more information, check the Enterprise Server Admin Guide.
* Web Services, SOAP and WSDL. For more information, see http://www.w3.org/2002/ws/.
* PHP language. For more information, see: www.php.net.

## Revision history

Revision | Description
--- | ---
v1.0.0 | Initial writing. Up-to-date for Enterprise 7.
v2.0.0 | Updates for Enterprise 7.4, 7.6 and 8.0.
v3.0.0 | Updates for Enterprise 8.2 and 9.0.
v3.0.1 | Added notes for Java SOAP clients.
v3.1.0 | Updates for Enterprise 9.1, 9.2, 9.3, 9.4 and 9.5.
v3.2.0 | Updates for Enterprise 9.7 and 9.8.
v3.3.0 | Updates for Enterprise 10.0.
v3.4.0 | Updates for Enterprise 10.2.

## Conventions used in this manual
Throughout this guide, Smart Connection is sometimes abbreviated as SC, while Content Station is sometimes abbreviated as CS.
The following special styling is used:

Convension | Meaning
--- | ---
Italic | Literal reference. Typically used to refer to a term in an example as used literally.
colored | Literal reference. Typically used to refer from one example to another as used literally.
[n] | Numeric reference. Typically referring to a specific numeric bullet used in an example.
“quoted” | Literal text. Typically used literally in English GUI.
underlined | Hyperlink reference to web site, paragraph or chapter.
... | Used in examples to indicate there is more information, which is not relevant, and therefore hidden.
-> | Path separator used in references locating data in hierarchically structured data trees, such as SOAP. For example Hello -> World refers to “hi” in this fragment:`<Hello><World>hi</World></Hello>`
"--" | Description of a feature that was introduced since the specified version. In this example, since Enterprise v6.1.

Mixed Case	"A name, term or entity that is considered to be known to the reader, such as Enterprise or WoodWing. 
Note that SOAP elements (as defined in WSDL files) are also mixed case and therefore literally used in this guide."

## Support
To discuss any Web Services related issues, visit WoodWing’s Help Center site: https://helpcenter.woodwing.com/hc/en-us/community/topics/200276265-Development-Webservices (log-in required). If you require further support for Enterprise, visit the WoodWing support web site at http://www.WoodWing.com/support and follow the directions for submitting questions.
