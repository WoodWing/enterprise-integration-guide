---
layout: chapter
title: Dossier Labels [since 9.1]
sortid: 070
---

Object labels can be created for Dossiers (and Dossier Templates) in order to filter Dossiers by one or more of these labels so that only those objects are shown. Once a label is created, it can be updated (renamed) or deleted for the Dossier. When a Dossier gets created (CreateObjects) it inherits the labels from its template.

The following example creates a ‘Foo’ label for a Dossier:

```xml
<CreateObjectLabels>
    <Ticket>...</Ticket>
    <ObjectId>123</ObjectId> <!-- Dossier Id-->
    <ObjectLabels>
        <ObjectLabel>
            <Id xsi:nil="true"/>
            <Name>Foo</Name> <!-- The name of the Dossier label -->
        </ObjectLabel>
    </ObjectLabels>
</CreateObjectLabels>
```

```xml
<CreateObjectLabelsResponse>
    <ObjectLabels>
        <ObjectLabel>
            <Id>1</Id> <!-- The id of the created label -->
            <Name>Foo</Name>
        </ObjectLabel>
    </ObjectLabels>
</CreateObjectLabelsResponse>
```

This is how to rename the ‘Foo’ label into a ‘Bar’ label:

```xml
<UpdateObjectLabels>
    <Ticket>...</Ticket>
    <ObjectLabels>
        <ObjectLabel>
            <Id>1</Id>
            <Name>Foo</Name>
        </ObjectLabel>
    </ObjectLabels>
</UpdateObjectLabels>
```

```xml
<UpdateObjectLabelsResponse>
    <ObjectLabels>
        <ObjectLabel>
            <Id>1</Id>
            <Name>Bar</Name>
        </ObjectLabel>
    </ObjectLabels>
</UpdateObjectLabelsResponse>
```

Deleting the label goes like this:

```xml
<DeleteObjectLabels>
    <Ticket>...</Ticket>
    <ObjectLabels>
        <ObjectLabel>
            <Id>1</Id>
            <Name xsi:nil="true"/>
        </ObjectLabel>
    </ObjectLabels>
</DeleteObjectLabels>
```

```xml
<DeleteObjectLabelsResponse/>
```

When an object is contained by a Dossier, the object can be labelled as well. However, only labels that were created for the parent Dossier can be chosen. They therefore travel with the ‘contained’ object relation (with Dossier as parent and the object as child) whereas labels for Dossiers travel directly with the object.

For contained objects we speak of ‘adding’ and ‘removing’ labels (instead of ‘creating’ and ‘deleting’). These operations work with labels that already exist for the parent Dossier of the contained object.

This is how to add an existing label to a contained object:

```xml
<AddObjectLabels>
    <Ticket>...</Ticket>
    <ParentId>123</ParentId> <!-- Dossier Id-->
    <ChildIds>
        <String>456</String> <!-- id of object, contained by the Dossier (ParentId) -->
    </ChildIds>
    <ObjectLabels>
        <ObjectLabel>
            <Id>1</Id>
            <Name xsi:nil="true"/>
        </ObjectLabel>
    </ObjectLabels>
</AddObjectLabels>
```

```xml
<AddObjectLabelsResponse/>
```

And this way you can remove that label again (from the contained object):

```xml
<RemoveObjectLabels>
    <Ticket>...</Ticket>
    <ParentId>123</ParentId> <!-- Dossier Id-->
    <ChildIds>
        <String>456</String> <!-- id of object, contained by the Dossier (ParentId) -->
    </ChildIds>
    <ObjectLabels>
        <ObjectLabel>
            <Id>1</Id>
            <Name xsi:nil="true"/>
        </ObjectLabel>
    </ObjectLabels>
</RemoveObjectLabels>
```

```xml
<RemoveObjectLabelsResponse/>
```

Labels defined for a Dossier can be retrieved through the *GetObjects* service by using a new *RequestInfo* option named ‘ObjectLabels’ as follows:

```xml
<GetObjects>
    <Ticket>...</Ticket>
    <IDs>
        <String>123</String> <!-- Dossier id -->
    </IDs>
    ...
    <RequestInfo>
        ...
        <String>ObjectLabels</String> <!-- new option since 9.1 -->
        ...
    </RequestInfo>
    ...
```
Because labels are defined for the Dossier itself, the server returns them directly under the *Object* element as shown here:

```xml
<GetObjectsResponse>
    <Objects>
        <Object>
            <MetaData>
                <BasicMetaData>
                    <ID>123</ID> <!-- Dossier id -->
                ...
            </MetaData>
            ...
            <Relations>
                <Relation>
                    <Parent>123</Parent> <!-- Dossier id -->
                    <Child>456</Child> <!-- id of object, contained by the Dossier (Parent) -->
                    <Type>Contained</Type>
                    ...
                    <ObjectLabels>
                        <ObjectLabel>
                            <Id>1</Id>
                            <Name>Foo</Name>                   
                        </ObjectLabel>
                    </ObjectLabels>
                </Relation>
            </Relations>
            ...
            <ObjectLabels>
                <ObjectLabel>
                    <Id>1</Id>
                    <Name>Foo</Name>
                </ObjectLabel>
            </ObjectLabels>
            ...
```

Similar as for Dossiers, labels can be requested for ‘contained’ objects as well. For example:

```xml
<GetObjects>
 
    <Ticket>...</Ticket>
    <IDs>
        <String>456</String> <!-- id of object, contained by the Dossier -->
    </IDs>
    ...
    <RequestInfo>
        ...
        <String>ObjectLabels</String> <!-- new option since 9.1 -->
        ...
    </RequestInfo>
    ...
```

Because the labels are defined for the Dossier (and not for the ‘contained’ object) the server returns them under the ‘Contained’ *Relation* element with the Dossier as parent:

```xml
<GetObjectsResponse>
    <Objects>
        <Object>
            <MetaData>
                <BasicMetaData>
                    <ID>456</ID> <!-- id of object, contained by the Dossier -->
                ...
            </MetaData>
            ...
            <Relations>
                <Relation>
                    <Parent>123</Parent> <!-- Dossier id -->
                    <Child>456</Child> <!-- id of object, contained by the Dossier (Parent) -->
                    <Type>Contained</Type>
                    ...
                    <ObjectLabels>
                        <ObjectLabel>
                            <Id>1</Id>
                            <Name>Foo</Name>                    
                        </ObjectLabel>
                    </ObjectLabels>
                </Relation>
            </Relations>
            ...
            <ObjectLabels/> <!-- empty: no object labels for this object type -->
            ...
```
