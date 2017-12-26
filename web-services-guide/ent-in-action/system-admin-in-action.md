---
layout: chapter
title: System Administration in Action
sortid: 090
permalink: 1041-system-admin-in-action
---
## Adding Sub-Applications to Content Station \[since 9.0\]

This chapter won’t tell you how to develop your sub-application in Flex nor how to physically embed it into Content Station. 
Instead it describes how to enable admin users to configure access rights for your own sub-applications that run inside 
Content Station and how to provide a download URL which enables users to install or upgrade your application with ease.

First you need to develop a Server Plug-in. Since Enterprise 9.0 that is as simple as creating a folder in the 
Enterprise/config/plugins folder with a name (camel case) followed by running the Server Plug-ins page. In the folder 
you’ll find a new PluginInfo.php file that was generated for you. In that file you should uncomment the following option 
(by removing the leading // slashes):

`// 'SysGetSubApplications_EnterpriseConnector',`

Save the file and run the Server Plug-ins page again, which now generates a connector that implements the 
SysGetSubApplications\_EnterpriseConnector interface. Open the &lt;YourPluginName&gt;\_SysGetSubApplications.class.php 
file and implement the runAfter() function as follows:

```php
final public function runAfter( SysGetSubApplicationsRequest $req, SysGetSubApplicationsResponse &$resp )
{
	if( is_null($req->ClientAppName) || // request for all clients?
		$req->ClientAppName == 'ContentStation' ) { // request for this client only?

		require_once BASEDIR.'/server/interfaces/services/sys/DataClasses.php';
		$subApp = new SysSubApplication();
		$subApp->ID = 'ContentStation_FooSubApp';
		$subApp->Version = '1.0.0 Build 1';
		$subApp->PackageUrl = 'http://foosubapp.com';
		$subApp->DisplayName = 'Foo Sub App';
		$subApp->ClientAppName = 'ContentStation';
		$resp->SubApplications[] = $subApp;
	}
} 
```

Having the Server Plug-in activated, when the admin user now runs the Profile Maintenance page (under Access Profiles menu), 
the SysGetSubApplications service is called and so the code snippet above is executed. As a result, your sub-application 
is listed under the Applications section at the Profile Maintenance page. This enables the admin user to set up a profile 
that gives end-users access to your sub-application. On the Brand Maintenance page under User Authorizations, the admin 
user can select that profile for certain user groups.

![]({{ site.baseurl }}{% link web-services-guide/images/image48.png %})

With the access profiles in place, when the end-user logs in to Content Station, Enterprise Server returns the profiles 
that are configured for that user. By default, all applications are assumed to be enabled. For such applications, simply 
no information is returned in the profile at all. Only when an application has been disabled in a profile will an entry 
be added to the LogOnResponse for that AppFeature. The value for it is set to “No” as shown in the following fragment of 
the LogOnResponse:

```xml
<LogOnResponse>
	...
	<FeatureProfiles>
	...
		<FeatureProfile>
			<Name>Access Sample</Name>
			<Features>
				...
				<AppFeature>
					<Name>ContentStation_FooSubApp</Name>
					<Value>No</Value>
				</AppFeature>
```

In the very same response, Content Station checks which profiles have been configured for the Publications (= Brands). 
The following fragment shows how access profiles are organized per Brand:

```xml
<LogOnResponse>
	...
	<Publications>
		<PublicationInfo>
			...
			<FeatureAccessList>
				<FeatureAccess>
					<Profile>Access Sample</Profile>
					<Issue xsi:nil="true"/>
					<Section xsi:nil="true"/>
					<State xsi:nil="true"/>
				</FeatureAccess>
			</FeatureAccessList>
			...
```

Looking at both fragments above, if any PublicationInfo (=Brand) has a FeatureAccess (=profile reference) that corresponds 
with a FeatureProfile (=profile definition) for which the sub-application is not listed, Content Station will show your 
sub-application since the user has access to it (through at least one of the Brands). Obviously that is only the case 
when your sub-application is returned through the SysGetSubApplications service.
