
[![Build Status](http://3.84.45.239:8080/buildStatus/icon?job=xooa-php-sdk-1)](http://3.84.45.239:8080/job/xooa-php-sdk-1/)


Xooa PHP SDK
===================

*The official Xooa SDK for PHP to connect with the Xooa PaaS.*

This class contains all the public functions available by SDK.

This SDK refers to APIs available for Xooa platform. For more details, refer: <https://api.xooa.com/explorer>

The platform documentation is available at <https://docs.xooa.com>

## Installation

The AWS Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`xooa/xooa-sdk` package in your project's `composer.json`.

```json
{
    "require": {
        "xooa/xooa-sdk": "^1.0"
    }
}
```

Then run a composer update
```sh
php composer.phar update
```

## usage

```php
use XooaSDK\XooaClient;
$XooaClient = new XooaClient("<Xooa API Token>");
$XooaClient->validate();
```

Properties
----------

### \$loggingLevel {.public}

``` {.signature}
$loggingLevel : string
```



#### Type

string — Should contain logging level for SDK  - [DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAl, ALERT, EMERGENCY]


==


### \$log {.public}

``` {.signature}
$log : string
```



#### Type

string — Should contain an instance of object of Monolog/logger


==

### \$DEFAULT\_CALLOUT\_BASE\_URL {.private}

``` {.signature}
$defaultCalloutBaseUrl : string
```



#### Type

string — Should contain a Xooa URL to call APIs from if not set by User


==

### \$apiToken {.private}

``` {.signature}
$apiToken : string
```



#### Type

string — Should contain a Xooa API Token to authorize requests retrieved from Xooa console


==

### \$calloutBaseUrl {.private}

``` {.signature}
$calloutBaseUrl : string
```



#### Type

string — Should contain a Xooa URL to call APIs from


==

### \$webService {.private}

``` {.signature}
$webService : string
```



#### Type

string — Should contain an instance of Xooa SDK webservice


==

Methods
-------

### \_\_construct() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
__construct(  $apiToken) 
```

*Used to get a reference to XooaClient for calling the various methods
defined*

#### Parameters

  -- ------------ --
     \$apiToken   
  -- ------------ --


==

### getApiToken() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getApiToken() : void
```

*Gets the API Token to use for calling the API*


==

### setUrl() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
setUrl(string  $calloutBaseUrl) : void
```

*Sets the base URL to calls APIs from*

#### Parameters

  -------- ------------------ --
  string   \$calloutBaseUrl   
  -------- ------------------ --


==

### getUrl() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getUrl() : void
```

*Gets the base URL to call APIs from*


==

### setLoggingLevel() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
setLoggingLevel(string  $loggingLevel) : void
```

*Sets the logging level for PHP SDK*

#### Parameters

  -------- ---------------- --
  string   \$loggingLevel   
  -------- ---------------- --


==

### setWebService() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
setWebService(\XooaSDK\WebService  $webService) : void
```

*Sets the object of SDK WebService*

#### Parameters

  ----------------------- -------------- --
  \\XooaSDK\\WebService   \$webService   
  ----------------------- -------------- --


==

### validate() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
validate() : true
```

*Provides a way to validate the ApiToken via a Https call*

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php) -   if invalid

#### Returns

true —

-   if valid


==

### invoke() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
invoke(  $functionName,   $args = array(),   $timeout = 3000) : \XooaSDK\InvokeResponse
```

*The invoke function is used for submitting transaction for processing by the blockchain smart contract app when the transaction payload need to be persisted into the Ledger (new block is mined).
It must pass a function parameter function already defined in your smart contract app which will process the invoke request.*

#### Parameters

  -- ---------------- --
     \$functionName   
     \$args           
     \$timeout        
  -- ---------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\InvokeResponse](src/response/InvokeResponse.php)


==

### invokeAsync() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
invokeAsync(  $functionName,   $args = array()) : \XooaSDK\PendingTransactionResponse
```

*The invoke function is used for submitting transaction for processing by the blockchain smart contract app aynchronously when the transaction payload need to be persisted into the Ledger (new block is mined).
It must pass a function parameter function already defined in your smart contract app which will process the invoke request.*

#### Parameters

  -- ---------------- --
     \$functionName   
     \$args           
  -- ---------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)

#### Returns

[\\XooaSDK\\PendingTransactionResponse](src/response/PendingTransactionResponse.php)


==

### query() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
query(  $functionName,   $args = array(),   $timeout = 3000) : \XooaSDK\QueryResponse
```

*The query API function is used for querying (reading) a blockchain ledger using smart contract function.
It must pass a function parameter function already defined in your smart contract app which will process the query request.*

#### Parameters

  -- ---------------- --
     \$functionName   
     \$args           
     \$timeout        
  -- ---------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\QueryResponse](src/response/QueryResponse.php)


==

### queryAsync() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
queryAsync(  $functionName,   $args = array()) : \XooaSDK\PendingTransactionResponse
```

**The query API function is used for querying (reading) a blockchain ledger using smart contract function aynchronously.
It must pass a function parameter function already defined in your smart contract app which will process the query request.**

#### Parameters

  -- ---------------- --
     \$functionName   
     \$args           
  -- ---------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)

#### Returns

[\\XooaSDK\\PendingTransactionResponse](src/response/PendingTransactionResponse.php)


==

### currentIdentity() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
currentIdentity() : \XooaSDK\IdentityResponse
```

*Gets the detail about identity currently set*

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\IdentityResponse](src/response/IdentityResponse.php)


==

### getIdentities() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getIdentities() : array<\XooaSDK\IdentityResponse>
```

*Get all identities from the identity registry
`Required permission`: manage identities (canManageIdentities=true)*

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

array\<[\\XooaSDK\\IdentityResponse](src/response/IdentityResponse.php)\> —

IdentityResponse


==

### enrollIdentity() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
enrollIdentity(\XooaSDK\json  $identityRequest, integer  $timeout = 3000) : \XooaSDK\IdentityResponse
```

*The Enroll identity function is used to enroll new identities for the smart contract app. A success response includes the API Token generated for the identity. This API Token can be used to call API End points on behalf of the enrolled identity.

This function provides equivalent functionality to adding new identity manually using Xooa console, and identities added using this function will appear, and can be managed, using Xooa console under the identities tab of the smart contract app

`Required permission`: manage identities (canManageIdentities=true)*

#### Parameters

  ----------------- ------------------- --
  \\XooaSDK\\json   \$identityRequest   
  integer           \$timeout           
  ----------------- ------------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\IdentityResponse](src/response/IdentityResponse.php)


==

### enrollIdentityAsync() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
enrollIdentityAsync(\XooaSDK\json  $identityRequest) : \XooaSDK\PendingTransactionResponse
```

*The Enroll identity function is used to enroll new identities for the smart contract app asynchronously. A success response includes the API Token generated for the identity. This API Token can be used to call API End points on behalf of the enrolled identity.

This function provides equivalent functionality to adding new identity manually using Xooa console, and identities added using this function will appear, and can be managed, using Xooa console under the identities tab of the smart contract app

`Required permission`: manage identities (canManageIdentities=true)*

#### Parameters

  ----------------- ------------------- --
  \\XooaSDK\\json   \$identityRequest   
  ----------------- ------------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)

#### Returns

[\\XooaSDK\\PendingTransactionResponse](src/response/PendingTransactionResponse.php)


==

### regenerateIdentityApiToken() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
regenerateIdentityApiToken(string  $identityId, integer  $timeout = 3000) : \XooaSDK\IdentityResponse
```

*Generates new identity API Token

`Required permission`: manage identities (canManageIdentities=true)*

#### Parameters

  --------- -------------- --
  string    \$identityId   
  integer   \$timeout      
  --------- -------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\IdentityResponse](src/response/IdentityResponse.php)


==

### regenerateIdentityApiTokenAsync() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
regenerateIdentityApiTokenAsync(string  $identityId) : \XooaSDK\PendingTransactionResponse
```

*Regenerates Identity API token asynchronously*

#### Parameters

  -------- -------------- --
  string   \$identityId   
  -------- -------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)

#### Returns

[\\XooaSDK\\PendingTransactionResponse](src/response/PendingTransactionResponse.php)


==

### getIdentity() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getIdentity(string  $identityId, integer  $timeout = 3000) : \XooaSDK\IdentityResponse
```

*Get the specified identity from the identity registry

`Required permission`: manage identities (canManageIdentities=true)*

#### Parameters

  --------- -------------- --
  string    \$identityId   
  integer   \$timeout      
  --------- -------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\IdentityResponse](src/response/IdentityResponse.php)


==

### deleteIdentity() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
deleteIdentity(string  $identityId, integer  $timeout = 3000) : \XooaSDK\DeleteResponse
```

*Deletes an identity.

`Required permission`: manage identities (canManageIdentities=true)*

#### Parameters

  --------- -------------- --
  string    \$identityId   
  integer   \$timeout      
  --------- -------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\DeleteResponse](src/response/DeleteResponse.php)


==

### deleteIdentityAsync() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
deleteIdentityAsync(string  $identityId) : \XooaSDK\PendingTransactionResponse
```

*Deletes the given identity asynchronously*

#### Parameters

  -------- -------------- --
  string   \$identityId   
  -------- -------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)

#### Returns

[\\XooaSDK\\PendingTransactionResponse](src/response/PendingTransactionResponse.php)


==

### getCurrentBlock() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getCurrentBlock() : \XooaSDK\CurrentBlockResponse
```

*Use this function to Get the block number and hashes of current (highest) block in the network*

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\CurrentBlockResponse](src/response/CurrentBlockResponse.php)


==

### getCurrentBlockAsync() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getCurrentBlockAsync() : \XooaSDK\PendingTransactionResponse
```

*Gets the detail about current block asynchronously*

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)

#### Returns

[\\XooaSDK\\PendingTransactionResponse](src/response/PendingTransactionResponse.php)


==

### getBlockByNumber() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getBlockByNumber(integer  $blockNumber) : \XooaSDK\BlockResponse
```

*Use this function to Get the number of transactions and hashes of a specific block in the network parameters*

#### Parameters

  --------- --------------- --
  integer   \$blockNumber   
  --------- --------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\BlockResponse](src/response/BlockResponse.php)


==

### getBlockByNumberAsync() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getBlockByNumberAsync(integer  $blockNumber) : \XooaSDK\PendingTransactionResponse
```

*Gets the detail about given block number asynchronously*

#### Parameters

  --------- --------------- --
  integer   \$blockNumber   
  --------- --------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)

#### Returns

[\\XooaSDK\\PendingTransactionResponse](src/response/PendingTransactionResponse.php)


==

### getResultForInvoke() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getResultForInvoke(string  $resultId) : \XooaSDK\InvokeResponse
```

*This function returns the result of previously submitted invoke pending request*

#### Parameters

  -------- ------------ --
  string   \$resultId   
  -------- ------------ --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\InvokeResponse](src/response/InvokeResponse.php)


==

### getResultForQuery() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getResultForQuery(string  $resultId) : \XooaSDK\QueryResponse
```

*This function returns the result of previously submitted query pending request*

#### Parameters

  -------- ------------ --
  string   \$resultId   
  -------- ------------ --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\QueryResponse](src/response/QueryResponse.php)


==

### getResultForIdentity() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getResultForIdentity(string  $resultId) : \XooaSDK\IdentityResponse
```

*This function returns the result of previously submitted pending request*

#### Parameters

  -------- ------------ --
  string   \$resultId   
  -------- ------------ --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\IdentityResponse](src/response/IdentityResponse.php)


==

### getResultForDeleteIdentity() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getResultForDeleteIdentity(string  $resultId) : \XooaSDK\DeleteResponse
```

*This function returns the result of previously submitted delete identity pending request*

#### Parameters

  -------- ------------ --
  string   \$resultId   
  -------- ------------ --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\DeleteResponse](src/response/DeleteResponse.php)


==

### getResultForCurrentBlock() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getResultForCurrentBlock(string  $resultId) : \XooaSDK\CurrentBlockResponse
```

*This function returns the result of previously submitted current block pending request*

#### Parameters

  -------- ------------ --
  string   \$resultId   
  -------- ------------ --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\CurrentBlockResponse](src/response/CurrentBlockResponse.php)


==

### getResultForBlockByNumber() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getResultForBlockByNumber(string  $resultId) : \XooaSDK\BlockResponse
```

*This function returns the result of previously submitted block pending request*

#### Parameters

  -------- ------------ --
  string   \$resultId   
  -------- ------------ --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\BlockResponse](src/response/BlockResponse.php)

==

### getResultForTransaction() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getResultForTransaction(string  $resultId) : \XooaSDK\TransactionResponse
```

*This function returns the result of previously submitted transaction pending request*

#### Parameters

  -------- ------------ --
  string   \$resultId   
  -------- ------------ --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)
[\\XooaSDK\\exception\\XooaRequestTimeoutException](src/exception/XooaRequestTimeoutException.php)

#### Returns

[\\XooaSDK\\TransactionResponse](src/response/TransactionResponse.php)

==

### subscribeAllEvents() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
subscribeAllEvents(callable $callbackOnEvent)
```

*Subscribes to all events*

#### Parameters

  ---------- ------------------- --
  callable   \$callbackOnEvent   
  ---------- ------------------- --

#### Throws

[\\XooaSDK\\exception\\XooaApiException](src/exception/XooaApiException.php)


==

### unsubscribe() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
unsubscribe()
```

*Unsubscribes all events*
: 
