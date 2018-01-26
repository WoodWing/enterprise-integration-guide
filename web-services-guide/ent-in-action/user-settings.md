---
layout: chapter
title: User Settings
sortid: 210
permalink: 1059-user-settings
---
User settings are stored in Enterprise per user per client application. A user setting can be any kind of data the client application wants to make persistent for the user (for example: user defined queries, recently opened tabs or panels, the dossiers the user is working on, etc).

The client can choose between two different flows to handle the user settings. The next chapter describes the original, more rigid flow. The succeeding chapter describes a more dynamic flow which gives a better performance and is a better choice for web applications.

## Rigid flow (old, discouraged)
User settings can be returned through LogOn response and saved through LogOff request. 

During the years more and more information is added to the LogOn response which has made it an expensive service. It is more efficient to have smaller web services that can be called after the logon so the end-user does not need to wait before he/she can get started with the client application. If your client is using this rigid flow, please consider migrating to the dynamic flow to offload the user settings from the LogOn response.

Note that in this flow, it is allowed to have duplicate settings. For example, when SC saves the settings, the 'QueryPanel' setting may occur multiple times.

### LogOn
Client requests for all the user settings stored in the database.

```json
{
    ...
    "RequestInfo": [
        "Settings"
    ],
    ...
    "__classname__": "WflLogOnRequest"
}
```
```json
{
    ...
    "Settings": [
        {
            "Setting": "Foo1",
            "Value": "abc",
            "__classname__": "Setting"
        },
        {
            "Setting": "Bar",
            "Value": "123",
            "__classname__": "Setting"
        }
    ],
    ...
    "__classname__": "WflLogOnResponse"
}
```
### LogOff
Client provides a new collection of user settings. The `Foo1` setting will be removed, the `Foo2` setting will be added and the Bar setting will be updated.
```json
{
    ...
    "SaveSettings": true,
    "Settings": [
        {
            "Setting": "Foo2",
            "Value": "abc",
            "__classname__": "Setting"
        },
        {
            "Setting": "Bar",
            "Value": "456",
            "__classname__": "Setting"
        }
    ],
    ...
    "__classname__": "WflLogOffRequest"
}
```
## Dynamic flow (new, preferred) [since 10.3]
User settings are retrieved from Enterprise as soon as the client needs to access them. And, they are saved to Enterprise whenever the settings are changed.

In this flow, duplicate settings are not allowed; The name of each setting is assumed to be unique (per user/client). Note that when migration from the old- to the new flow this is something to take into consideration. It is the responsibility for the client to remove duplicate settings and start using unique settings.

### LogOn
Client tells that settings are *not* managed through LogOn/LogOff.
```json
{
    ...
    "RequestInfo": [],
    ...
    "__classname__": "WflLogOnRequest"
}
```
Because in the RequestInfo the `Settings` are missing, the server does not resolve them:
```json
{
    ...
    "Settings": null,
    ...
    "__classname__": "WflLogOnResponse"
}
```
### LogOn: migration
Since 10.3 the `PreferNoSettings` option is added which enables client applications handling user settings through the LogOn/LogOff services to migrate to the GetUserSettings/SaveUserSettings services that are introduced with ES 10.3 and meanwhile support both 10.2 and 10.3. By passing both `Settings` and `PreferNoSettings` options, ES 10.2 returns the settings through the LogOnResponse->Settings while ES 10.3 does not. The client can check if LogOnResponse->ServerInfo->Version >= 10.3 and call the new GetUserSettings services instead.
```json
{
    ...
    "RequestInfo": [
        "Settings",
        "PreferNoSettings"
    ],
    ...
    "__classname__": "WflLogOnRequest"
}
```
ES 10.2 response:
```json
{
    ...
    "Settings": [
        {
            "Setting": "Foo1",
            "Value": "abc",
            "__classname__": "Setting"
        },
        {
            "Setting": "Bar",
            "Value": "123",
            "__classname__": "Setting"
        }
    ],
    ...
    "__classname__": "WflLogOnResponse"
}
```
ES 10.3 response:
```json
{
    ...
    "Settings": null,
    ...
    "__classname__": "WflLogOnResponse"
}
```
### GetUserSettings: get all settings
Client retrieves all user settings at once:
```json
{
    ...
    "Settings": null,
    "__classname__": "WflGetUserSettingsRequest"
}
```
Basically, this gives the same collection of results as through the LogOn response:
```json
{
    ...
    "Settings": [
        {
            "Setting": "Foo1",
            "Value": "abc",
            "__classname__": "Setting"
        },
        {
            "Setting": "Bar",
            "Value": "123",
            "__classname__": "Setting"
        }
    ],
    ...
    "__classname__": "WflGetUserSettingsResponse"
}
```
Note that when the client has sub applications (such as the Publication Overview of Content Station) the settings could be prefixed by the client. To reduce the number of settings, it is advisable not to use the method described above, but to explicitly request for the settings that are supported by the client (sub)application as described in the next paragraph.

### GetUserSettings: get specific settings
Client (sub)application requests for the settings it supports:
```json
{
    ...
    "Settings": [
        "Bar"
    ],
    "__classname__": "WflGetUserSettingsRequest"
}
```
Only requested settings are returned:
```json
{
    ...
    "Settings": [
        {
            "Setting": "Bar",
            "Value": "123",
            "__classname__": "Setting"
        }
    ],
    ...
    "__classname__": "WflGetUserSettingsResponse"
}
```
### GetUserSettings: get prefixed settings
Client requests for all user settings with a specific prefix:
```json
{
    ...
    "Settings": [
        "Foo%"
    ],
    "__classname__": "WflGetUserSettingsRequest"
}
```
All user settings prefixed with `Foo` are returned:
```json
{
    ...
    "Settings": [
        {
            "Setting": "Foo1",
            "Value": "abc",
            "__classname__": "Setting"
        },
        {
            "Setting": "Foo2",
            "Value": "abc",
            "__classname__": "Setting"
        }
    ],
    ...
    "__classname__": "WflGetUserSettingsResponse"
}
```
Note that this method is most expensive and so the other get-methods (described in the paragraphs above) are preferred.

### DeleteUserSettings
Client detected that `Foo1` is no longer supported and therefore it removes it to avoid traveling this user setting over and over again between client and server.
```json
{
    ...
    "Settings": [
        "Foo1"
    ],
    ...
    "__classname__": "WflDeleteUserSettingsRequest"
}
```
If the client has received obsoleted settings, it is the responsibility to remove those settings.

### SaveUserSettings
Client noticed a value change in the user setting `Bar` and fires a save request. The Bar setting already exists in the database so the value will simply be updated.
```json
{
    ...
    "Settings": [
        {
            "Setting": "Bar",
            "Value": "456",
            "__classname__": "Setting"
        }
    ],
    ...
    "__classname__": "WflSaveUserSettingsRequest"
}
```
Client noticed a value change in the user setting `Foo2` and fires a save request. The `Foo2` setting does exists yet in the database and so it will be added.
```json
{
    ...
    "Settings": [
        {
            "Setting": "Foo2",
            "Value": "abc",
            "__classname__": "Setting"
        }
    ],
    ...
    "__classname__": "WflSaveUserSettingsRequest"
}
```
### LogOff
Client tells that settings are not managed through LogOn/LogOff.
```json
{
    ...
    "SaveSettings": false,
    "Settings": null,
    ...
    "__classname__": "WflLogOffRequest"
}
```
