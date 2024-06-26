---
layout: chapter
title: Object Searching
sortid: 120
permalink: 1048-object-searching
---

Object searching is the heart of Enterprise; it is a fundamental and complex centralized feature of the workflow system 
pumping objects through its veins. To breakdown complexity and to differentiate between all kind of search features, 
Enterprise has introduced several functional areas, as explained in this paragraph. The *search results* are explained 
in a following paragraph.

## Freestyle search

Enterprise supports freestyle search: users can search for objects their own way using various parameters. This feature 
is supported by the *QueryObjects* service. This subparagraph describes several ways of using this service.

## Full text search

The user can type just a piece of text to search for, without indicating to which object property the filtering should 
be applied. In fact, the user is grabbing for text through any property. The figure below shows how this search looks 
in Content Station.

![]({{ site.baseurl }}{% link web-services-guide/images/image41.png %}) 

When the user clicks the search button, the client application fires the *QueryObjects* request to the server. 
The fragment below shows how this looks. Since there is actually no specific property involved, it passes the reserved 
property name *Search* to trigger this feature in the server.

```xml
<QueryObjects>
	<Ticket>...</Ticket>
	<Params>
		<QueryParam>
			<Property>Search</Property>
			<Operation>=</Operation>
			<Value>hello world</Value>
		</QueryParam>
	</Params>
	...
```

## Browse search

The most direct and simple way of searching is by selecting one of the predefined filters (also known as Search Modes). 
The figure below shows that the user has chosen the “WW News” Brand and the “sport” Category using Content Station.

![]({{ site.baseurl }}{% link web-services-guide/images/image42.png %})

After clicking the search button, Content Station fires a search query, as shown in the fragment below. The ids of the 
Brand (formerly publication) and Category are passed.

```xml
<QueryObjects>
	<Ticket>...</Ticket>
	<Params>
		<QueryParam>
			<Property>PublicationId</Property>
			<Operation>=</Operation>
			<Value>1</Value>
		</QueryParam>
		<QueryParam>
			<Property>CategpryId</Property>
			<Operation>=</Operation>
			<Value>3</Value>
		</QueryParam>
	</Params>
	...
```

## User Query

In the “Dialog Setup” Maintenance page, system admin users can define what parameters are allowed for filtering within 
User Queries (the Search Modes “Search” or “Custom Search” in the client GUI). (See the Admin Guide for configuration 
details.) In the example below, the *In Use By* property is configured for the query parameters. Internally this 
property is named *LockedBy*.

![]({{ site.baseurl }}{% link web-services-guide/images/image43.png %}) 

A user logged in to a client application can add the pre-configured query parameters to any custom search query. The 
figure below shows a fraction of the “Search Criteria” dialog in InDesign. In this example, the user has just added the 
*LockedBy* property to his/her query:

![]({{ site.baseurl }}{% link web-services-guide/images/image44.png %}) 

InDesign then fires the query request as show in the fragment below. Now it uses the unequal operation (!=) and leaves 
the value empty, just like the user did. The server then returns all objects that are currently in use. See the last 
subparagraph for an example of how the results usually look.

```xml
<QueryObjects>
	<Ticket>...</Ticket>
	<Params>
		<QueryParam>
			<Property>LockedBy</Property>
			<Operation>!=</Operation>
			<Value/>
		</QueryParam>
	</Params>
	..
```

The full set of operators can be found in the workflow WSDL. The fragment below shows the definition (made for Enterprise Server 7.0) 
in two-fold. On the left, the WSDL is opened in a plain-text editor and on the right it is opened in an XML editor 
(or Web browser). The plain-text version shows that some operators use “&lt;”. This is the XML escaped representation of 
“&lt;” which means “less than”. In an XML editor (or Web browser) it shows the escaped version. The SOAP requests contain 
the escaped “&lt;” character because “&lt;” is a reserved symbol in XML. Nevertheless, this is hidden from client 
applications (using SOAP/XML tools) and from Server Plug-ins; they simply use the unescaped “&lt;” character.

![]({{ site.baseurl }}{% link web-services-guide/images/image45.png %})

```xml
<simpleType name="OperationType">
	<restriction base="string">
		<enumeration value="&lt;"/>
		<enumeration value=">"/>
		<enumeration value="&lt;="/>
		<enumeration value=">="/>
		<!-- 4.2 - Greater Than or Equal -->
		<enumeration value="="/>
		<enumeration value="!="/>
		<enumeration value="contains"/>
		<enumeration value="starts"/>
		<enumeration value="ends"/>
		<enumeration value="within"/>
		<!-- 5.0 Time interval -->
	</restriction>
</simpleType>
```

## Saving a User Query

Enterprise client applications allow users to save their queries. The user can fill in a name as shown in the figure to 
the right. At this stage, the query is saved in the memory of the client application. When the user logs out, the queries 
are stored in the server through the *LogOff* request, as shown in the fragment below. The WSDL tells that the *Value* 
element must be a string. Adding XML elements as a string would make the SOAP request invalid. Therefore the string is 
escaped. Escaped characters are hard to read for humans, so in the example below they are left out and green colored 
italic formatting is used instead.

![]({{ site.baseurl }}{% link web-services-guide/images/image46.png %})

```xml
<LogOff>
	<Ticket>...</Ticket>
	<SaveSettings xsi:type="xsd:boolean">true</SaveSettings>
	<Settings>
		<Setting>
			<Setting>UserQuery3_My Search</Setting>
				<Value>
					<?xml version="1.0" encoding="UTF-8" standalone="no" ?>
					<UserQuery>
						<QueryParam>
							<Type>string</Type>
							<Property>LockedBy</Property>
							<Operation>!=</Operation>
							<Value></Value>
						</QueryParam>
					</UserQuery>
				</Value>
			</Setting>
		</Setting>
...
```

The next time a user logs in again, the saved query is passed back (using the same structure) through the login response 
in the LogOnResponse -&gt; Settings element. The query is then made available to the user to run again (or to make 
justifications).

## Search by date

Search for workflow objects that have a datetime property set between 'now' and a relative datetime.
The client application can request the server to search within this timespan.

In a `QueryObjects` request, one or more `QueryParam` filters can be provided, each specifying the following attributes:
* `Property`: Name of any workflow object datetime property, such as `Created`, `Modified` or `Deleted`.
* `Operator`: Type of timespan, either `starts` or `within`. These options are explained in the paragraphs below.
* `Value`: Duration specifier relative to 'now'. The meaning and interpretation depends on the provided `Operator`. 
  * The syntax is inspired on http://www.w3.org/TR/2004/REC-xmlschema-2-20041028/datatypes.html#duration.
  * The syntax is partially respected; Not all options are supported. The supported options are written below.
  * The `starts` operation respects similar notation but gives it a different meaning than specified in the referred document. 

**The ‘starts’ operator**

This operator defines a search within the current, preceding or succeeding logical period of time, relative to 'now'.  

The server supports the following values for the `Value` attribute:

| value                  | meaning       | 
|------------------------|---------------|
| `-P1D` <sup>①</sup>    | yesterday     | 
| `P0D`  <sup>①</sup>    | today         |
| `P1D` <sup>①</sup>     | tomorrow      |
| ~~`-P7D`~~<sup>②</sup> | ~~last week~~ |
| `-P1W`<sup>②</sup>     | last week     |
| `P0W`<sup>②</sup>      | this week     |
| ~~`P7D`~~<sup>②</sup>  | ~~next week~~ |
| `P1W`<sup>②</sup>      |  next week    |

① Notes about the day unit:
* The day unit (`D`) is specified in the W3C standard (mentioned in the introduction above), but has a _different_ meaning here.
* A day starts from the first second of the day up to the last second of the day.
* Searching for 'yesterday' or 'tomorrow' includes the seconds of that day, but excludes the seconds of 'today'.
* Today includes the seconds of the current day, starting from 00:00:00 until 23:59:59.

② Notes about the week unit:
* The week unit (`W`) is _not_ specified in the W3C standard (mentioned in the introduction above).
* Searching for 'last week' or 'next week' includes the days of that week, but excludes the days of 'this week'. 
* A week starts from first day of the week up to the last day of the week. 
* The `FIRST_DAY_OF_WEEK` option in the `configserver.php` tells when a week starts.
* Since Studio Server 10.28 support for "this week" has been added. It returns the `ThisWeek` feature in the `LogOnResponse` to tell this feature is supported. See bullets below. 
* If the `ThisWeek` feature is returned, client applications:
  * can use the `P0W` value; 
  * should start using the `-P1W` and `P1W` values;
  * should no longer use the `-P7D` and `P7D` values.
* This is how the server returns the `ThisWeek` feature to the client application during the `LogOn` operation: 
  ```xml
  <LogOnResponse>
    ...
    <FeatureSet>
        <Feature>
            <Key>ThisWeek</Key>
            <Value xsi:nil="true"/>
        </Feature>
    </FeatureSet>
    ...
  </LogOnResponse>
  ```

Example request for objects that were modified yesterday:

```xml
<QueryObjects>
	<Ticket>...</Ticket>
	<Params>
		<QueryParam>
			<Property>Modified</Property>
			<Operation>starts</Operation>
			<Value>-P1D</Value>
		</QueryParam>
	</Params>
	..
```

**The ‘within’ operator**

This operator defines a search within a timespan defined by 'now' and the provided `Value`. This can be either looking
into the past or the future. Looking to the past is a common case, applicable to `Created` and `Modified` properties.
Looking into the future is a rare case; It could be applicable for custom object properties e.g. related to planning.
(Note that those custom properties must be of type `date` or `datetime`.)

The server validates the following syntax for the `Value` attribute:

`[-]? [P] [T]? [0-9]+ [DMH]`

The syntax has the following meaning:

* `[-]?` The `-` (minus) is optional. 
  * If provided, it requests to look into the past; A duration before 'now'. 
  * If omitted, it requests to look into the future; A duration starting from 'now'.
* `[P]` The `P` is mandatory and denotes a duration field.
* `[T]?` The time indicator `T` is optional. 
  * When `T` is provided, the duration represents a relative _time_.
  * When `T` is omitted, the duration represents a relative _date_.
* `[0-9]+` The number of duration units. One or more digits is allowed.
* `[DMH]` The duration unit, which must be _one_ of these options: `D`, `M` or `H`.
  * The meaning depends on whether `T` is specified:
    * When `T` is provided: `H` = hours, `M` = minutes. (`D` is not valid.)
    * When `T` is omitted: `D` = days, `M` = months. (`H` is not valid.)

Valid examples:
* `-PT30M` (= last 30 minutes)
* `PT4H` (= next 4 hours)
* `-P1M` (= last month)
* `P2D` (= next 48 hours)

Example request for objects that were created within the last half year:

```xml
<QueryObjects>
	<Ticket>...</Ticket>
	<Params>
		<QueryParam>
			<Property>Created</Property>
			<Operation>within</Operation>
			<Value>-P6M</Value>
		</QueryParam>
	</Params>
	..
```

## Predefined search

Enterprise supports predefined searches;: users can pick a predefined query (also called Named Query or Custom Search) 
and optionally use one of its parameters (if any). This feature is supported by the *NamedQuery* service. This paragraph 
describes several ways of using this service.

**Inbox**

Maybe the most frequently used query is the *Inbox* query. It shows the objects that are assigned to the user or one of 
the groups the user is in. From the *Inbox*, the user opens files that must be worked on. Up to Enterprise Server 6.x, the *Inbox* 
query was shipped as a true Named Query. This implies that any system admin user can adjust it in the “Named Queries” 
Maintenance page.

\[Since 7.0\] Since Enterprise Server 7.0, the *Inbox* is built-in to the server. Nevertheless, it still acts as a true Named Query, 
as if it still exists. It is hidden from the “Named Queries” Maintenance page though, so changes cannot be made anymore.

When a user selects and runs the *Inbox* query, client applications fire the *NamedQuery* request as shown in the fragment 
below. Content Station does this also automatically right after the user has logged in.

```xml
<NamedQuery>
	<Ticket>...</Ticket>
	<Query>Inbox</Query>
	<Params xsi:nil="true"/>
	...
```

**Named Query**

The “Named Queries” Maintenance page allows admin users to configure any Named Query (see the Admin Guide for details.) 
Let’s say he/she has made a query called “Name Search” and specified some parameters in the “Interface” field as shown 
in the fragment below. There are two parameters; *ObjectName* and *ObjectType*. The type has a default value *Layout* of 
a list with three options: *Article*, *Image* and *Layout*.

```
ObjectName,string
ObjectType,list,Layout,Article/Image/Layout
```
When the user logs in to Enterprise, the configured Named Queries are returned by the server through the *LogOnResponse*. 
The fragment below shows how that is done for our “Name Search” example query. Per query, it specifies which parameters 
can be used. For the example query you can find the two configured parameters.

```xml
<LogOnResponse>
	...
	<NamedQueries>
		<NamedQuery>
			<Name>Name Search</Name>
			<Params>
				<PropertyInfo>
					<Name>ObjectName</Name>
					...
				</PropertyInfo>
				<PropertyInfo>
					<Name>ObjectType</Name>
					...
				</PropertyInfo>
			</Params>
		</NamedQuery>
		...
```

Zooming into the details of ObjectType, the default value and its option are included:

```xml
<PropertyInfo>
	<Name>ObjectType</Name>
	<DefaultValue>Layout</DefaultValue>
	<ValueList>
		<String>Article</String>
		<String>Image</String>
		<String>Layout</String>
	</ValueList>
	...
</PropertyInfo>
```

After login, the client applications list the queries in their search panes, allowing users to pick one. In the figure 
below, the user logged in to InDesign and has picked our *Name Search* query and filled in a search string “hello world” 
for the *ObjectName* parameter. The *Layout* option of the *ObjectType* parameter is preselected (and remained untouched 
by user).

![]({{ site.baseurl }}{% link web-services-guide/images/image47.png %})

By clicking the Search button, InDesign fires the *NamedQuery* request as shown in the fragment below. Both parameters 
as filled in by the end user are sent along the request.

```xml
<NamedQuery>
	<Ticket>...</Ticket>
	<Query>Name Search</Query>
	<Params>
		<QueryParam>
			<Property>ObjectName</Property>
			<Operation>=</Operation>
			<Value>hello world</Value>
		</QueryParam>
		<QueryParam>
			<Property>ObjectType</Property>
			<Operation>=</Operation>
			<Value>Layout</Value>
		</QueryParam>
	</Params>
	...
```

## Search results

Regardless of the search technique used, the granular structure of the search results is always the same. This simplifies 
client applications and Server Plug-ins parsing results. Although there are two different responses specified in the 
workflow WSDL (*QueryObjectsResponse* and *NamedQueryResponse*), both have the same structure.

A search result is basically a table of columns and rows. Which columns are returned depends on the configurations made 
in the Maintenance pages:

* For the *QueryObjects* service, the returned columns are configured on the “Dialog Setup” page through “Query Result 
Columns” actions. (See the Admin Guide for configuration details.)
* For the *NamedQuery* service, the returned columns are determined by the SQL query as configured on the “Named Queries” 
page. (See the Admin Guide for configuration details.)
* Every found object in the search results is represented by a *Row* element, and its properties by *String* elements. 
An important assumption is that the n<sup>th</sup> *String* element corresponds with the n<sup>th</sup> *Property* 
element under *Columns*. The fragment below shows a search result listing two objects and three columns. The second 
column represents the object type. So the second *String* value of each row (object) contains the object type. The 
different colors show the mapping of rows to columns.

```xml
<QueryObjectsResponse>
	<Columns>
		<Property>
			<Name>ID</Name>
			<DisplayName>ID</DisplayName>
			<Type>string</Type>
		</Property>
		<Property>
			<Name>Type</Name>
			<DisplayName>Type</DisplayName>
			<Type>string</Type>
		</Property>
		<Property>
			<Name>Name</Name>
			<DisplayName>Name</DisplayName>
			<Type>string</Type>
		</Property>
		...
	</Columns>
	<Rows>
		<Row>
			<String>1708</String>
			<String>Article</String>
			<String>my article</String>
			...
		</Row>
		<Row>
			<String>1721</String>
			<String>Layout</String>
			<String>my pages</String>
			...
		</Row>
		...
	</Rows>
	...
```

Note that the *ID*, *Type* and *Name* properties are always returned, regardless of the configuration made. This is 
considered to be the bare minimum to provide client applications with. In other terms, clients may assume these properties 
are always present.

Regardless of the property, client applications and Server Plug-ins should never hard-code column positions. For example, 
the *Type* column is in the second position, but it can be located at any other position.

The principle shown in the following fragment may be used in your Server Plug-in (*WflQueryObjects* connector) to 
determine the column positions of those properties that you are looking for. When you are developing a client application, 
you could use this fragment as pseudo code. This custom example is only interested in *Type* and *Name* object properties. 
With those two column indexes available, it runs through the rows (objects) and checks the object type. For articles only, 
it adds “(article)” to the object name, to meet the customer’s requirements. This customization affects the search results 
of all clients. Obviously you can take out any other columns and perform any other custom operation to the rows.

```php
final public function runAfter( WflQueryObjectsRequest $req, WflQueryObjectsResponse &$resp )
{
	// Determine column indexes to work with
	$indexes = array( 'Type' => -1, 'Name' => -1 );
	foreach( array_keys($indexes) as $colName ) {
		foreach( $resp->Columns as $index => $column ) {
			if( $column->Name == $colName ) {
				$indexes[$colName] = $index;
				break; // found
			}
		}
	}
	// Run through rows to be returned and mark articles
	foreach( $resp->Rows as &$row ) { // for all rows to return soap client
		$type = $indexes['Type'] > -1 ? $row[ $indexes['Type']] : '';
		if( $type == 'Article' ) {
			if( $indexes['Name'] > -1 ) {
				$row[$indexes['Name']] .= ' (article)';
			}
		}
	}
}
```

Custom properties are set up on the “Metadata” Maintenance page. (See the Admin Guide for configuration details). These 
properties are internally prefixed with a “C\_”. For example, a custom property named “HELLO” is internally called 
“C\_HELLO”.
