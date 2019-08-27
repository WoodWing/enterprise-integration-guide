---
layout: chapter
title: Server Info
sortid: 31
permalink: 1244-server-info
---
Under the umbrella of a certain `Enterprise installation` all application servers and client applications are sharing one-and-the-same `storage location`. As a database system or database instance may contain multiple storage locations, we avoid these terms in this chapter. In short, one `Enterprise installation` is bound to one `storage location`. 

During the first time installation Enterprise Server generates a global unique identifier named `Enterprise System ID` and stores it in its `storage location`. Once this ID is determined, it will never change. It uniquely identifies the `Enterprise installation` world wide.

## Server identification
A client application may want to cache some information that originates from a specific `Enterprise installation`. Or, it may want to call certain services that were introduced in later versions of Enterprise Server. So there is a need know to which `Enterprise installation` it connects to.
 
 The Enterprise Server URL may change over time, and an `Enterprise installation` may get upgraded while reusing the very same URL. In other words, clients should never use URL to cache information that originates from a particular `Enterprise installation` nor compare URLs to conclude whether one instance differs from another.  

 Instead of the Enterprise Server URL, the `Enterprise System ID` should be used to uniquely identify an `Enterprise installation`. There are several ways how to retrieve this ID as described hereafter.
 
 ### GetServers service
  Although this service always has been provided, since Enterprise Server 10.8 the response contains the `Enterprise System ID`. This ID is only provided for the `ServerInfo` item that represents the `Enterprise installation` being requested. 
  
  Note that the `GetServers` service does not require a ticket and therefor it can be called even before calling the `LogOn` service. 
  
Example request in JSON:
```json
{
    "method": "GetServers",
    "id": "1",
    "params": {
        "req": {
            "__classname__": "WflGetServersRequest"
        }
    },
    "jsonrpc": "2.0"
}
```
Example response in JSON:
```json
{
    "id": "1",
    "result": {
        "Servers": [
            {
                "Name": "Enterprise",
                "URL": "http:\/\/localhost\/Enterprise\/index.php",
                ...
                "Version": "10.8.0 Build 123",
                ...
                "EnterpriseSystemId": "f8210fed-3e64-a351-bfa7-55e9a7bd83bf",
                "__classname__": "ServerInfo"
            }
        ],
        "CompanyLanguage": "enUS",
        "__classname__": "WflGetServersResponse"
    },
    "jsonrpc": "2.0"
}
```

### GetServerInfo service [since 10.7]
Example request in JSON:
```json
{
    "method": "GetServerInfo",
    "id": "1",
    "params": {
        "req": {
        	"Ticket": "...",
            "__classname__": "WflGetServerInfoRequest"
        }
    },
    "jsonrpc": "2.0"
}
```
Example response in JSON:
```json
{
    "id": "1",
    "result": {
        "ServerInfo": [
            {
                "Name": "Enterprise",
                "URL": "http:\/\/localhost\/Enterprise\/index.php",
                ...
                "Version": "10.8.0 Build 123",
                ...
                "EnterpriseSystemId": "f8210fed-3e64-a351-bfa7-55e9a7bd83bf",
                "__classname__": "ServerInfo"
            }
        ],
        "__classname__": "WflGetServerInfoResponse"
    },
    "jsonrpc": "2.0"
}
```

### LogOn service
Although this service always has been provided, since Enterprise Server 9.2 the response contains the `Enterprise System ID`. 
```json
{
    "method": "LogOn",
    "id": "1",
    "params": {
        "req": {
            "User": "John",
            "Password": "***",
            "Ticket": "",
            ...
            "RequestTicket": null,
            "RequestInfo": [
                "ServerInfo"
            ],
            "Params": null,
            "__classname__": "WflLogOnRequest"
        }
    },
    "jsonrpc": "2.0"
}
```
Example response in JSON:
```json
{
    "id": "1",
    "result": {
        "Ticket":"...",
        ...
        "ServerInfo": {
            "Name": "Enterprise",
            "URL": "http:\/\/localhost\/Enterprise\/index.php",
            ...
            "Version": "10.8.0 Build 123",
            ...
            "EnterpriseSystemId": "f8210fed-3e64-a351-bfa7-55e9a7bd83bf",
            "__classname__": "ServerInfo"
        }
        ...
        "__classname__": "WflLogOnResponse"
    },
    "jsonrpc": "2.0"
}
```

### Ping service [since 10.2]
The most light service to resolve the `Enterprise System ID` is the following:
* `http://localhost/Enterprise/index.php?test=ping`

Unlike examples mentioned above, this service request is _not_ a JSON RPC request but a simple HTTP GET request. The service may (or may not) return a JSON body, depending on the Enterprise Server version:
* 10.1 or older gives a HTTP 302 (redirect to the admin logon page)
* 10.2 - 10.7 gives a HTTP 200 with an empty body
* 10.8 or newer gives a HTTP 200 with a JSON body (see example below)

Example response [since 10.8]:
```json
{
   Name: "Enterprise",
   Version: "10.8.0 Build 123",
   EnterpriseSystemId: "f8210fed-3e64-a351-bfa7-55e9a7bd83bf"
}
```

## Server status service [since 10.8]
For a load balancer you may want to configure a light service that periodically determines whether an `Enterprise installation` is still healthy. The following service request can be configured:
* `http://localhost/Enterprise/index.php?test=status`

Unlike examples mentioned above chapter, this service request is _not_ a JSON RPC request but a simple HTTP GET request.

Example response:
```json
{
	Name: "Enterprise",
	Version: "10.8.0 Build 123",
	EnterpriseSystemId: "f8210fed-3e64-a351-bfa7-55e9a7bd83bf",
	Status: {
		Filestore: "OK",
		Database: "OK",
		FileTransferServer: "OK"
	}
}
```
If all items under the `Status` entry indicate `OK`, this service returns a `HTTP 200 OK`. If any of the items indicate `ERROR` the service returns a `HTTP 500 Internal Server Error`.
