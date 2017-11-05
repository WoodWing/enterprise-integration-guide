---
layout: chapter
title: Suggestions and Auto-completion [since 9.1]
sortid: 080
---

For a functional explanation of these two features and how to set them up, see the 'Tags' section of the *Enterprise Server Online Help*.

Enterprise Server offers two new connector interfaces for Server Plug-ins to implement:
* A suggestions connector interface (SuggestionProvider\_EnterpriseConnector)
* An auto-complete connector interface (AutocompleteProvider\_EnterpriseConnector)

When a plug-in implements the suggestions connector interface, it becomes a suggestions provider. And, when implementing the auto-complete connector interface, it becomes an auto-complete provider. For example: the OpenCalais plug-in is a suggestion provider, and the Drupal7 plug-in is an auto-complete provider.

When a user opens a Publish Form, Enterprise Server requests the installed providers whether or not they support all custom object properties that are configured for that form and includes these in the response.

The following example shows these attributes in bold:

```xml
<GetDialog2Response>
    ...
    <Tabs>
        ...
        <DialogWidget>
            <PropertyInfo> <!-- metadata setup -->
                <Name>C_DRUPAL_CITIES</Name>
                ...
                <!-- 9.1 -->
                <TermEntity>Cities</TermEntity>
                <SuggestionEntity>City</SuggestionEntity>
                <AutocompleteProvider>Drupal7</AutocompleteProvider>
                <SuggestionProvider>OpenCalais</SuggestionProvider>
                ...
```
The property attributes explained:

* ***TermEntity:*** Abstract name for a term. When given, it could be recognized by any auto-complete provider to help the user filling in the property.
* ***SuggestionEntity:*** Abstract name for a Suggestion. It defines the entity for the types of tags that need to be suggested by the Suggestion Provider, such as 'City', 'Movie', 'TVShow' and so on.\
* Note that suggestion providers are loosely coupled regarding the publishing providers. For example, OpenCalais and Drupal integrations do not need to know from each other. The challenge here is that for a custom object property, only the publishing connector and the external publishing system know what it is about. For example, a Cities field from Drupal, the custom property could be named C\_DRUPAL\_CITIES, which means nothing to OpenCalais. To tackle this challenge, a new attribute is added to the *PropertyInfo* element and is named *SuggestionEntity*. Having this abstract information in place, both integrated systems know where the property stands for.
* ***AutocompleteProvider:*** The internal name of the Server Plug-in that has an auto-complete connector that supports this custom object property.
* ***SuggestionProvider:*** The internal name of the Server Plug-in that has an auto-complete connector that supports this custom object property.

## Auto-complete

Now the Publish Form is shown, the user can fill in the field. Let’s say that the user has already tagged "Amsterdam" in the Cities field of the Publish Form. Now the user  types "Ams" to create another tag. Even though it matches with "Amsterdam" it is no longer suggested.

The client fires the following request:

```xml
<Autocomplete>
    <Ticket>...</Ticket>
    <AutocompleteProvider>AutocompleteSample</AutocompleteProvider> <!-- plugin name -->
    <PublishSystemId xsi:nil="true"/> <!-- 9.1 GUID -->
    <ObjectId>123</ObjectId> <!-- object id of Publish Form which the user is filling in -->
    <Property>
        <Name>C_DRUPAL_CITIES</Name> <!-- custom obj prop introduced by Drupal connector -->
        <Entity>City</Entity> <!-- entity of the property -->
        <IgnoreValues> <!-- tags that were already selected before in the Cities field -->
            <String>Amsterdam</String>
        </IgnoreValues>
    </Property>
    <TypedValue>Ams</TypedValue> <!-- user typed value (so far) for the custom Cities field -->
</Autocomplete>
```

The server returns the following response:

```xml
<AutocompleteResponse>
    <Tags>
        <!-- Amsterdam is not listed because it was requested to ignore -->
        <!-- Amstel is not listed because the entity is not a City -->
        <AutoSuggestTag>
            <Value>Amstelveen</Value>
            <Score>0.85</Score>
            ...
        </AutoSuggestTag>
        <AutoSuggestTag>
            <Value>Adamstown</Value> <!-- matches half-way -->
            <Score>50</Score>
            ...
        </AutoSuggestTag>
    </Tags>
</AutocompleteResponse>
```

## Suggestions

Now the Publish Form is shown, the user can fill in the field. Let’s say that the user has typed an article about Amsterdam and presses the ‘Suggest’ button:

```xml
<Suggestions>
    <Ticket>...</Ticket>
    <SuggestionProvider>OpenCalais</SuggestionProvider> <!-- internal plugin name -->
    <ObjectId>123</ObjectId> <!-- object id of Publish Form which the user is filling in -->
    <MetaData> <!-- CS sends strings, multilines and text components only -->
        <MetaDataValue>
            <Property>C_DRUPAL_HEAD</Property>
            <Values>
                <String>Facts about Amsterdam</String>
            </Values>
        </MetaDataValue>
        <MetaDataValue>
            <Property>C_DRUPAL_BODY</Property>
            <Values>
                <String>The Amstel river and the Noordzee canal run through this city.</String>
            </Values>
        </MetaDataValue>
    </MetaData>
    <SuggestForProperties> <!-- for optimization of the response -->
        <AutoSuggestProperty>
            <Name>C_DRUPAL_CITIES</Name>
            <Entity>City</Entity>
            <IgnoreValues xsi:nil="true"/>
        </AutoSuggestProperty>
        <AutoSuggestProperty>
            <Name>C_DRUPAL_RIVERS</Name>
            <Entity>Natural Feature</Entity>
            <IgnoreValues xsi:nil="true"/>
        </AutoSuggestProperty>
    </SuggestForProperties>
</Suggestions>
```

The server returns the following response:

```xml
<SuggestionsResponse>
    <SuggestedTags>
        <!-- "Noordzee canal" is not returned; OpenCalais tells it has entity "Facility" -->
        <EntityTags>
            <Entity>City</Entity>
            <Tags>
                <AutoSuggestTag>
                    <Value>Amsterdam</Value>
                    <Score>0.52</Score>
                    ...
                </AutoSuggestTag>
            </Tags>
        </EntityTags>
        <EntityTags>
            <Entity>Natural Feature</Entity>
            <Tags>
                <AutoSuggestTag>
                    <Value>Amstel river</Value>
                    <Score>0.38</Score>
                    ...
                </AutoSuggestTag>
            </Tags>
        </EntityTags>
    </SuggestedTags>
</SuggestionsResponse>
```
