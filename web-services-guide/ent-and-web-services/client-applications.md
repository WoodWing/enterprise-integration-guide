---
layout: chapter
title: Client Applications
sortid: 50
permalink: 1029-client-applications
---

The Web Service interfaces are accessible in different ways. The way to choose depends on the programming language used 
to develop your application and the way it needs to be deployed. Most common programming languages today support 
Web Services, including PHP, Java, RealBasic, VisualBasic, C++, C\#, Flex and many more. Enterprise Server implements 
its interfaces with PHP. When your solution is written in a programming language other than PHP, you need to develop 
a client application that talks Web Services as specified by the WSDLs of Enterprise Server.

Typically the WSDL file is read by your SOAP library/tool to generate a proxy class (from its operations) and a bunch 
of data classes (from its type definitions). This way, you can build a request data structure based on the generated 
data classes, and fire the request through the proxy class by simply calling one of its methods (operations). The proxy 
takes care of building the SOAP request itself and parsing the returned SOAP response. In other terms, all SOAP 
challenges are encapsulated and hidden from your solution.

![]({{ site.baseurl }}{% link web-services-guide/images/image14.png %})

Enterprise WSDLs refer to the DIME attachment specification to send documents along with SOAP traffic. DIME is required 
up to and including Enterprise Server 7. Since Enterprise Server 8 it is possible to move away from DIME and use the 
*Transfer Server* instead to send documents directly over HTTP. This is faster in execution and easier to integrate 
than DIME and therefore clients are encouraged to use the Transfer Server.

When your solution is written in PHP, you can use helper classes shipped with Enterprise Server. When your solution 
-always- runs on the -same- server machine (as the Enterprise Server) you can use the *PHP service helper classes*. 
This way, your solution is executed by the very same process as the application server, as shown on the left side of 
the figure below. When it needs to be installed on other server machines though, you need the *PHP SOAP helper classes*. 
In this situation, whether it runs on the same(!) machine or not, your solution runs in a separate process, as shown on 
the right side of the figure below. In this case, there is a little overhead of SOAP traffic.

![]({{ site.baseurl }}{% link web-services-guide/images/image15.png %})

## .NET clients and Java clients using SOAP

Enterprise 7 has changed the standard notation used for arrays in the WSDL files. (See also *Arrays*.) As a result, 
.NET and Java integrations could no longer use the WSDL files shipped with the server, and the array definitions 
needed to be manually changed back to the ‘old’ notation.

For example, this was the ‘old’ notation used for Enterprise 6 (and older):
```xml
<complexType name="ArrayOfUser">
	<sequence>
		<element name="User" minOccurs="0" maxOccurs="unbounded" type="tns:User"/>
	</sequence>
</complexType>
```

while this is the ‘new’ notation used for Enterprise 7 (and later):
```xml
<complexType name="ArrayOfUser">
	<complexContent>
		<restriction base="soap-enc:Array">
			<attribute ref="soap-enc:arrayType" wsdl:arrayType="tns:User[]"/>
		</restriction>
	</complexContent>
</complexType>
```

To solve this incompatibility, Enterprise 8 has introduced an option that automatically converts any requested WSDL 
file from the new into the old array notation on-the-fly.

## .NET clients

When importing WSDL files in your .NET project, please add the ws-i value to the wsdl parameter to trigger that 
conversion, for example:
`http://localhost/Enterprise/index.php?wsdl=ws-i`

At the time of updating this document with Enterprise 8 info, a demo application is being developed in .NET showing 
how to integrate with Enterprise (which uses this conversion method). Once completed, the application will appear on Labs.

## Java clients

Enterprise Server 8 makes it easier to integrate with Java clients. Java classes are generated from the WSDL and 
shipped in the SDK folder at the following location:
`Enterprise/sdk/java/src`

This is done for all data structures (simpleType), requests and response classes. Whenever changes are made to the WSDL, 
regenerated classes are shipped with the server. Therefore make sure to reimport and compile the classes in your Java 
project to use the latest features.

From Enterprise 8.3.2. / 9.0.2 onwards, essential fixes have been made to the Java classes shipped in the SDK folder. 
These fixes solve fatal errors in your Java client. For example:

`org.xml.sax.SAXException: Invalid element in com.woodwing.enterprise.interfaces.services.wfl.PublicationInfo - PublicationInfo`

The shipped Java classes with Enterprise Server 8.0.x, 8.1.x, 8.2.x, 8.3.0, 8.3.1, 9.0.0 and 9.0.1 cannot be used. 
For those versions it is needed to regenerate the classes yourself. That can be done with the WSDL2Java tool from 
Apache Axis:

`java org.apache.axis.wsdl.WSDL2Java -u -W -p com.woodwing.enterprise.interfaces.services.wfl http://localhost/Enterprise/index.php?wsdl=ws-i -o out`

Note that the special `wsdl=ws-i` parameter triggers Enterprise Server to change the array definitions into WS-I notation 
for the requested WSDL (as explained earlier in this chapter). Support for this parameter is introduced in Enterprise 8. 
Earlier versions do not ship the Java classes, but you could generate them yourself as written above. For Enterprise 7 
you could copy the WSDLs and manually adjust all the array definitions (as explained earlier in this chapter) before you 
generate the Java classes.

A “HelloWorld” sample application made in Java is available from *WoodWing Labs,* showing how to logon to Enterprise Server 
through the SOAP workflow interface by using the generated Java classes. Use this sample as a starting point.

## JavaScript clients using JSON \[since 8.0\]

When developing a JavaScript client that integrates with Enterprise Server, JSON is the most suitable and recommended 
protocol to use. The basic concept is as follows: Some JavaScript functions can be built into an HTML web page. Instead 
of refreshing / reloading the entire page on user submits, the web page keeps loaded and the JavaScript functions 
communicate with the server in the background. Ajax technology is used to fire JSON RPC requests over HTTP to 
Enterprise Server. Technically this is done asynchronously to keep the web browser responsive while waiting for the 
server’s response (but logically it could feel synchronous with the end-user waiting for a response too). When the 
response arrives, a registered callback function in JavaScript is triggered, which allows the client to continue its 
procedure. With all this in place, we speak of a JavaScript client application.

All operations specified in any of the *Web Service Interfaces* can be used with JSON. But unlike SOAP, for 
JSON there are no request or data classes shipped. This is with a reason: It would lead into downloading all class 
definitions from server to client before the client can start talking. This significant overhead is something to avoid 
for the sake of performance (and there is no technical need to have such classes in place). The communication using 
JSON is very light weighted and data properties that are not known by client or server are simply not sent over HTTP. 
Basically, everything that is defined as nil / nullable can be simply left out (unlike SOAP that has to specify 
the property being set to nil) which reduces communication traffic.

For example, this is how a LogOn request looks like:

```json
{
	"jsonrpc":"2.0",
	"method":"LogOn",
	"params":[{
		"User":"woodwing",
		"Password":"ww",
		"ClientName":"localhost",
		"ClientAppName":"my demo web app",
		"ClientAppVersion":"8.0",
		"RequestTicket":true
	}],
	"id":2
}
```

On the server, arrived JSON classes are mapped onto PHP classes like done for SOAP. Therefore the client 
application should specify the class names so that Enterprise Server can do the mapping. (This is not needed for the 
request class itself since it is already specified in the “method” parameter the JSON RPC structure.) Enterprise Server 
expects the first property of an object to be named “\_\_classname\_\_” that caries the name of the data class (which 
is the same as the complexType as specified in the WSDL file). For example, the GetPagesInfo request takes an Issue 
and an Edition data classes, which therefore must be specified, as done by the red marked fragments:

```json
{
	"jsonrpc":"2.0",
	"method":"GetPagesInfo",
	"params":[{
		"Ticket":"c1a0844ep03hRxZAvy5SE7mGmBEsHHCTVBzVmAhC",
		"Issue":{
			"__classname__":"Issue",
			"Id":"2"
		},
		"IDs":{},
		"Edition":{
			"__classname__":"Edition",
			"Id":"1"
		}
	}],
	"id":4
}
```

> At the time of updating this document with Enterprise 8 info, a demo application is being developed in JavaScript 
showing how to integrate with Enterprise with JSON (using jQuery). Once completed, the application will appear on Labs.

Note that the demo client application includes some JavaScript modules that takes care of the low level communication 
details written above, except for the “\_\_classname\_\_” property that needs to be set by the client. Basically those 
classes can be used for any integration using the JSON RPC 2.0 standard. However, they are enriched with some error 
handling to simplify clients working with exception handling. Therefore, when developing your own client application, 
please copy the JavaScript classes included by the demo.

You client application (HTML page) should have the very same web root location as Enterprise Server. For example, when 
the client application accesses the server through the “*http://localhost/enterprise/index.php*” entry point, then the 
client application should reside under the "*http://localhost*/" web root as well. Doing so, Make sure the URL in your 
web browser address bar is -exactly- the same as the one used in jQuery.Zend.jsonrpc(...) in the example scripts. Note 
that even “localhost” and “127.0.0.1” do NOT match.

## PHP clients using SOAP

Especially for backend integrations PHP could be used to integrate Enterprise Server. It is possible to integrate with 
Enterprise Server ‘internally’ or ‘externally’. It is important to categorize your client in one of the two since it 
has a big impact on the whole solution.

***Internal PHP integrations*** are custom PHP modules triggered by a custom web application (or crontab) that include 
Enterprise Server directly, or Server Plug-ins that are included by Enterprise Server. They run within the very same PHP 
process as Enterprise Server. Therefore the integration does not need to run over an HTTP connection, which makes the 
integration easier to develop and faster in execution.

***External PHP integrations*** are custom stand-alone PHP client applications. Their PHP modules run at a server 
machine and they communicate to Enterprise Server over an HTTP connection. Therefore they are called *client* applications, 
seen from Enterprise Server point of view. The SOAP is the most obvious protocol to chose for such integrations. When it 
is needed to upload or download files to Enterprise Server, DIME can still be used but is no longer recommended. It is 
better to integrate the *Transfer Server* instead, which runs over another HTTP connection.

## Internal PHP integrations

PHP data classes as well as service request- and response classes are generated from the WSDLs and shipped with 
Enterprise Server located in this folder:

`.../Enterprise/server/services/<interface>`

For example, this is how you can create a new user:

```php
require_once( '.../Enterprise/config/config.php' ); // TODO: Replace ... with web root folder!
require_once BASEDIR.'/server/secure.php';
require_once BASEDIR.'/server/interfaces/services/adm/DataClasses.php'; // AdmUser
require_once BASEDIR.'/server/services/adm/AdmCreateUsersService.class.php';
try {
	// Build new user in memory.
	$userObj = new AdmUser();
	$userObj->Name = 'woodwing';
	$userObj->FullName = 'WoodWing Software'
	$userObj->Deactivated = false;
	$userObj->Password = 'ww';

	// Build service request to create a new user.
	$request = new AdmCreateUsersRequest();
	$request->Ticket = '...'; // TODO: Fill-in your ticket here! (take it from LogOn)
	$request->RequestModes = array();
	$request->Users = array( $userObj );

	// Request Enterprise to create user in the database.
	$service = new AdmCreateUsersService();
	$response = $service = WW_DIContainer::get( AdmCreateUsersService::class ); // Since 10.7.0
	// $response is an AdmCreateUsersResponse object

	// Just display the user’s DB id of the created user.
	echo $response->Users[0]->Id;
} catch( BizException $e ) {
	echo $e->getMessage();
}
```

Basically, the whole pattern of calling services is always the same, no matter what service is called. First build a 
request object in memory and then execute the service by passing in the request. This returns a response object which 
can be used to validate or analyze the results. This is all shown in the example.

The DataClasses.php file is included to define all PHP classes derived (generated) from the WSDL file, in this case 
SmartConnectionAdmin.wsdl. In the WSDL data classes are defined by so called complexType elements. In this case the 
complexType “User” is of our interest. For each complexType a PHP data class is generated, which is listed in the 
DataClasses.php file. The PHP classes have a prefix to indicate the interface they originate from. (By exception, no 
prefixes are used for the workflow interface.) For this case Adm prefix is used, and so for the “User” complexType a 
PHP class named “AdmUser” is generated. See *Definitions and entry points* to look up interfaces and prefixes. The 
\$user variable represents the AdmUser object instance for which properties can be set.

> It is a good habit *not* to list parameter values in the constructor, but to explicitly assign values to the created 
object’s properties individually, as done in the example for Name, FullName, etc. The reason is that parameters might 
appear or disappear in the future, which might break your code when using constructors. When using properties, your 
code won’t break.

To create users, the WSDL specifies CreateUsersRequest and CreateUsersResponse elements. For those elements PHP classes 
are generated as well, and again prefixed, for this interface with Adm. By including the AdmCreateUsersService.class.php 
three classes are included at once:\
AdmCreateUsersService, AdmCreateUsersRequest and AdmCreateUsersResponse. Those objects are used to execute the service.

### Changes since 10.7.0

Due to internal changes in the service, business and database layers of Enterprise Server, the way that services are 
loaded has changed. Loading services that are introduced since 10.7 and higher can only be achieved when using:

`$service = WW_DIContainer::get( WflGetNamedQueriesService::class );`

Services that existed before 10.7 can still be loaded with the old code (e.g. `$service = new WflGetNamedQueriesService();`) 
but is deprecated. Existing services can change in later versions and throw a PHP error. You are therefore encouraged 
to update your code to use the new syntax. 

If you have an integration that needs to support both pre-10.7 versions and 10.7 and higher you can use the following 
code to be backwards compatible:

```php
$service = getServiceInstance( WflGetNamedQueriesService::class );

function getServiceInstance( $classname )
{
	if ( class_exists( 'WW_DIContainer' ) ) {
		return WW_DIContainer::get( $classname );
	}
	return new $classname();
}
```

## External PHP integrations

For automatic data class mapping and DIME attachment support, Enterprise has extended PHP’s SoapClient class with its 
WW\_SOAP\_Client class. For each interface flavor, another class is provided, such as WW\_SOAP\_AdmClient which 
communicates with the Administration interface. (See *Definitions and entry points* for the list of available interfaces.) 
These classes parameterize the WW\_SOAP\_Client class with the corresponding entry point and WSDL information, and map 
WSDL elements to PHP classes for programming convenience. All these classes can be found in this folder:

`.../Enterprise/server/protocols/soap`

The figure below shows how the classes inherit from each other, as displayed in the middle. On the left side, your PHP 
client code is calling any of the helper classes. On the right, the Enterprise Server is invoked through SOAP to execute 
a service.

![]({{ site.baseurl }}{% link web-services-guide/images/image16.png %})

Some test modules in the .../Enterprise/server/wwtest folder use the SOAP helper classes from where you might want to 
take some useful code fragments:
* workflow interface: speedtest.php
* admin interface: adminservicetest.php
* planning interface: clientplan.php
* data source interface: datasourceservicetest.php

Note that even for an external integration, you can still include classes from Enterprise Server without using 
Enterprise Server as a server. A good reason for that is to profit from the helper- and data classes to speed up your 
client developments.

An example of a SOAP client application calling the admin interface (over HTTP), which is requested to create a new user 
and retrieve its database id:

```php
require_once( dirname(__FILE__).'/../../config/config.php' );
try {
	$ticket = '...'; // TODO: Fill-in your ticket here! (take it from LogOn)
	
	// Build new user in memory.
	require_once BASEDIR.'/server/interfaces/services/adm/DataClasses.php'; // AdmUser
	$userObj = new AdmUser();
	$userObj->Name = 'woodwing';
	$userObj->FullName = 'WoodWing Software';
	$userObj->Deactivated = false;
	$userObj->Password = 'ww';

	// Build service request to create a new user.
	require_once BASEDIR.'/server/interfaces/services/adm/AdmCreateUsersRequest.class.php';
	$request = new AdmCreateUsersRequest();
	$request->Ticket = $ticket;
	$request->RequestModes = array();
	$request->Users = array( $userObj );

	// Request Enterprise to create user in the database.
	require_once BASEDIR.'/server/protocols/soap/AdmClient.php';
	$soapClient = new WW_SOAP_AdmClient();
	$response = $soapClient->CreateUsers( $request );

	// Just display the user’s DB id of the created user.
	echo 'Created user with DB id: '.$response->Users[0]->Id.'<br/>';
} catch( SoapFault $e ) {
	echo $e->getMessage() . '<br/>';
} catch( BizException $e ) {
	echo $e->getMessage() . '<br/>';
}
```

## External PHP integrations - stand alone

The disadvantage of the helper- and data classes is, that you need to copy them from the Enterprise Server machine to 
your own server and keep them in sync. Alternatively you can use the PHP SoapClient class directly, but keep in mind that:
* There is no support for file transfers.
* There is no data class mapping done on the client side. This means you need to work with stdClass objects only.

The same example as above, but now without any helper classes:

```php
try {
	$ticket = '...'; // TODO: Fill-in your ticket here! (take it from LogOn)

	// Build new user in memory.
	$userObj = new stdClass();
	$userObj->Name = 'woodwing';
	$userObj->FullName = 'WoodWing Software';
	$userObj->Password = 'ww';

	// Build service request to create a new user.
	$request = new stdClass();
	$request->Ticket = $ticket;
	$request->RequestModes = array();
	$request->Users = array( $userObj );

	// Request Enterprise to create user in the database.
	$soapClient = new SoapClient(
 		'http://localhost/Enterprise/adminindex.php?wsdl',
		array(	'location' => 'http://localhost/Enterprise/adminindex.php',
			'uri' => 'urn:SmartConnectionAdmin',
			'soap_version' => SOAP_1_1, 'trace' => 1 ));
	$response = $soapClient->CreateUsers( $request );

	// Just display the user’s DB id of the created user.
	echo 'Created user with DB id: '.$response->Users[0]->Id.'<br/>';
} catch( SoapFault $e ) {
	echo $e->getMessage() . '<br/>';
}
```

## External PHP integrations - with Transfer Server \[since 8.0\]

For integrations with the *Transfer Server* a helper class in the utils folder is available named WW\_Utils\_TransferClient. 
This class can upload or download files to/from the Transfer Server over HTTP.

The example below illustrates how this helper class can be used. First an object is retrieved through the workflow interface 
with the GetObjects service call. The native file rendition is thereby requested. The 'transfer' =&gt; 'HTTP' option tells 
the server to use the Transfer Server (instead of DIME). As a result, the GetObjects response contains a URL to the 
Transfer Server to download the file. The WW\_Utils\_TransferClient utils class is used to download that native file.

```php
require_once( dirname(__FILE__).'/../../config/config.php' );
require_once BASEDIR.'/server/secure.php';
try {
	$ticket   = '...'; // TODO: Fill-in your ticket here! (take it from LogOn)
	$objectId = '...'; // TODO: Fill-in the object id your want to download native file for!
	
	// Request for native file for an object.
	require_once BASEDIR.'/server/services/wfl/WflGetObjectsService.class.php';
	$request = new WflGetObjectsRequest();
	$request->Ticket = $ticket;
	$request->IDs = array( $objectId );
	$request->Lock = false;
	$request->Rendition = 'native';

	// Request Enterprise to create user in the database.
	require_once BASEDIR.'/server/protocols/soap/WflClient.php';
	$options = array( 'transfer' => 'HTTP', 'protocol' => 'SOAP' );
	$soapClient = new WW_SOAP_WflClient( $options );	
	$response = $soapClient->GetObjects( $request );
	$attachment = $response->Objects[0]->Files[0];
	
	// Download the native file from Transfer Server.
	require_once BASEDIR.'/server/utils/TransferClient.class.php';
	$transferClient = new WW_Utils_TransferClient( $ticket );
	if( $transferClient->downloadFile( $attachment ) ) {
		echo 'Downloaded file successfully.<br/>';
	} else {
		echo 'ERROR: Failed downloading file.<br/>';
	}
} catch( SoapFault $e ) {
	echo $e->getMessage() . '<br/>';
} catch( BizException $e ) {
	echo $e->getMessage() . '<br/>';
}
```

The example below shows roughly how to upload files. After doing so, the attachment can be passed to a CreateObjects or 
SaveObjects request.

```php
try {
	$ticket = '...'; // TODO: Fill-in your ticket here! (take it from LogOn)

	// Build a native image attachment in memory.
	$attachment = new Attachment();
	$attachment->FilePath = '/full/path/to/my/native/image/file.jpg'; // TODO: adjust
	$attachment->Rendition = 'native';
	$attachment->Type = 'image/jpeg';

	// Upload the image file to the Transfer Server folder.
	require_once BASEDIR.'/server/utils/TransferClient.class.php';
	$transferClient = new WW_Utils_TransferClient( $ticket );
	$transferClient->uploadFile( $attachment );

	// TODO: Call CreateObjects or SaveObjects

} catch( BizException $e ) {
	echo $e->getMessage() . '<br/>';
}
```