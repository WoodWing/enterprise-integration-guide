---
layout: chapter
title: Object Variants [since 10.4]
sortid: 125
permalink: 1060-object-variants
---

This chapter explains the Object Variants feature that was introduced since Enterprise Server 10.4.

## A master object and its variants
When copying a workflow object, in most cases the intention is to start a variant of that object. In other words, a copy 
is mostly made to create another variation of content. The object being copied is called the master object and the 
copy itself is called the object variant. Once the copy is made, users and client application may want to find out which 
object variants exist for a given object and who is the master object. 

## The "ID of original" object property
For the Object Variants feature an object property named "ID of original" is introduced that refers to the id of the 
master object. Internally this property is named `MasterId`. When set to zero ('0') the object itself is not a variant. 
It could be either a master object (of which variants are made) or a normal workflow object (that has no variants). 
When set to a positive numeric value, the object itself is a variant and the number refers to the id of the master object 
it is copied from. 

## Deleting a master object 
When a master object gets removed, the `MasterId` property set for its object variants will purposely *not* be cleared 
by the system. In other words, it is not guaranteed that the `MasterId` refers to an existing object. 
That makes this concept very different from Object Relations, since those always refer to existing objects and are 
automatically removed when their parent- or child object gets removed. For this reason Object Variants are not based 
on Object Relations. 

## Create a variant of a variant
After making a copy of a variant, the master remains the master, the variant remains the variant and the copy of the 
variant is just another variant. The master of the first copy becomes the same as the master of the second copy. 
In other words, both variants refer to the same master. In short, it can be stated that:
* A variant created from another variant share one and the same master. 
* A variant used to create another variant does *not* become a master. 
* The master is the root/source object of its variants and their variants (variants of variants). 

## Create a variant through a Copy To operation
When a client application calls the `CopyObject` web service, Enterprise Server takes care of setting the `MasterId` property. 
This property is set for all copied workflow objects except for Template-, Dossier-, Task-, Hyperlink- and Library objects. 
The client application calls the service without need to change anything in the request data:
```xml
<CopyObject>
    <Ticket>...</Ticket>
    <SourceID>123</SourceID>
    <MetaData>
        <BasicMetaData>
            <ID xsi:nil="true"/>
            <DocumentID xsi:nil="true"/>
            <Name>Copy of layout 123</Name>
            <Type xsi:nil="true"/>
            ...
            <MasterId xsi:nil="true"/>
        </BasicMetaData>
    ...
</CopyObject>
```
Enterprise Server uses the `SourceID` to resolve the `MasterId`:
* When layout with `ID` 123 has no `MasterId`, the `MasterId` of the copied layout is set to 123.
* When layout with `ID` 123 has a `MasterId` set to 120, the `MasterId` of the copied layout is set to 120.

In the example the following response may be returned:
```xml

<CopyObjectResponse>
    <MetaData>
        <BasicMetaData>
            <ID>124</ID>
            <DocumentID>...</DocumentID>
            <Name>Copy of layout 123</Name>
            <Type>Layout</Type>
            ...
            <MasterId>123</MasterId>
        </BasicMetaData>
    ...
</CopyObjectResponse>
```

## Create a variant through a Save As operation
When a client application allows the user to Save As the currently opened document, it calls the `CreateObjects` web service. 
The client should take the `MasterId` from the opened document (taken from `GetObjects`) and send it along with the 
`CreateObjects` request. If the `MasterId` is zero ('0') the client should take the `ID` from the opened document instead.

Basically the Save As operation is a kind of Copy To operation but now implemented by the client; There is no way for 
the server to find out whether the new object is copied from another object or created from scratch. Therefore it is the 
client's responsibility to implement the feature for this scenario by providing the correct value for the new `MasterId` 
property in the `CreateObjects` request:
```xml
<CreateObjects>
    <Ticket>...</Ticket>
    <Lock>true</Lock>
    <Objects>
        <Object>
            <MetaData>
                <BasicMetaData>
                    <ID xsi:nil="true"/>
                    <DocumentID>...</DocumentID>
                    <Name>SaveAs of layout 123</Name>
                    <Type>Layout</Type>
                    ...
                    <MasterId>123</MasterId>
                </BasicMetaData>
    ...
</CreateObjects>
```
Enterprise Server stores the new value provided for the `MasterId` in the database and in this example it returns 
the following response:
```xml
<CreateObjectsResponse>
    <Ticket>...</Ticket>
    <Lock>true</Lock>
    <Objects>
        <Object>
            <MetaData>
                <BasicMetaData>
                    <ID>124</ID>
                    <DocumentID>...</DocumentID>
                    <Name>SaveAs of layout 123</Name>
                    <Type>Layout</Type>
                    ...
                    <MasterId>123</MasterId>
                </BasicMetaData>
    ...
</CreateObjectsResponse>
```

## Searching for a master and its variants
When searching for objects that have a `MasterId` set to a certain value, all variants (copies) of that master and all
variants of variants are returned except for the master object itself. To invoke the master as well, the `ID` property 
should be queried too. 
However, the `QueryObjects` service won't allow composing such query because when searching for two properties, assumed 
is that the `AND` operator should be applied. Only when searching for two different values of the same property the `OR` 
operator is applied. In other words, searching for "`ID` = 123 OR `MasterId` = 123" can not be done with this service. 
Instead, a Named Query `OriginalObjectsAndVariants` is introduced that that can be called through the `NamedQuery` web 
service as follows:

```xml
<NamedQuery>
    <Ticket>...</Ticket>
    <Query>OriginalObjectsAndVariants</Query>
    <Params>
        <QueryParam>
            <Property>MasterId</Property>
            <Operation>=</Operation>
            <Value>123</Value>
            ...
        </QueryParam>
    </Params>
    ...
</NamedQuery>
```

## Parallel Editions / Related Pages
The Publication Overview application in Content Station 11 can show related pages of a selected layout page. 
This is called the Parallel Editions feature. For this feature the `GetRelatedPages` and `GetRelatedPagesInfo` 
services are called which make use of the `MasterId` to find out which master and which variants exist for the 
selected layout page. The services return the master and all its variants regardless whether the selected layout page 
is a master or a variant.

## Create Print Variant
Content Station 11 allows to create a print article (variant object) from a digital article (master object). 
For that it calls the `CreateObjectOperations` web service to let the Content Station server plug-in create the 
print variant and to set the `MasterId` for the created print article. As a result, the `MasterId` property of 
the print article refers to the `ID` property of the digital article. This enables Content Station to find out 
which print article is created from which digital article and visualise this in the UI and make smarter suggestions 
which digital articles to place on the layout preview.
