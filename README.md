Xooa PHP SDK
===================

*This is the base class of PHP SDK.*

This class contains all the public functions available by SDK.

Summary
-------

[Methods](#methods)

[Properties](#properties)

[Constants](#constants)

[\_\_construct()](#__construct-public)\
 [getApiToken()](#getapitoken-public)\
 [setUrl()](#setUrl-public)\
 [getUrl()](#getUrl-public)\
[setLoggingLevel()](#setLoggingLevel-public)\
[setWebService()](#setWebService-public)\
 [validate()](#validate-public)\
 [invoke()](#invoke-public)\
 [invokeAsync()](#invokeAsync-public)\
 [query()](#query-public)\
 [queryAsync()](#queryAsync-public)\
[currentIdentity()](#currentIdentity-public)\
[getIdentities()](#getIdentities-public)\
[enrollIdentity()](#enrollIdentity-public)\
[enrollIdentityAsync()](#enrollIdentityAsync-public)\
[regenerateIdentityApiToken()](#regenerateIdentityApiToken-public)\
[regenerateIdentityApiTokenAsync()](#regenerateIdentityApiTokenAsync-public)\
 [getIdentity()](#getIdentity-public)\
[deleteIdentity()](#deleteIdentity-public)\
[deleteIdentityAsync()](#deleteIdentityAsync-public)\
[getCurrentBlock()](#getCurrentBlock-public)\
[getCurrentBlockAsync()](#getCurrentBlockAsync-public)\
[getBlockByNumber()](#getBlockByNumber-public)\
[getBlockByNumberAsync()](#getBlockByNumberAsync-public)\
[getResultForInvoke()](#getResultForInvoke-public)\
[getResultForQuery()](#getResultForQuery-public)\
[getResultForIdentity()](#getResultForIdentity-public)\
[getResultForDeleteIdentity()](#getResultForDeleteIdentity-public)\
[getResultForCurrentBlock()](#getResultForCurrentBlock-public)\
[getResultForBlockByNumber()](#getResultForBlockByNumber-public)\
[\$loggingLevel](#loggingLevel-public)\
 [\$log](#log-public)\
[\$DEFAULT\_CALLOUT\_BASE\_URL](#default_callout_base_url-private)\
 [\$apiToken](#apiToken-private)\
[\$calloutBaseUrl](#calloutBaseUrl-private)\
 [\$webService](#webService-private)

Properties
----------

### \$loggingLevel {.public}

``` {.signature}
$loggingLevel : string
```



#### Type

string — Should contain logging level for SDK


==


### \$log {.public}

``` {.signature}
$log : string
```



#### Type

string — Should contain an object of logger


==

### \$DEFAULT\_CALLOUT\_BASE\_URL {.private}

``` {.signature}
$DEFAULT_CALLOUT_BASE_URL : string
```



#### Type

string — Should contain a Xooa URl to send APIs to if not set by User


==

### \$apiToken {.private}

``` {.signature}
$apiToken : string
```



#### Type

string — Should contain a Xooa API Token to authorize requests


==

### \$calloutBaseUrl {.private}

``` {.signature}
$calloutBaseUrl : string
```



#### Type

string — Should contain a Xooa URl to send APIs to


==

### \$webService {.private}

``` {.signature}
$webService : string
```



#### Type

string — Should contain an object of Xooa SDK webservice


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

*Sets the base URl to send calls to*

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

*Gets the base URl to send calls to*


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

\\XooaSDK\\exception\\XooaApiException
:   -   if invalid

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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\InvokeResponse


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

\\XooaSDK\\exception\\XooaApiException
:   

#### Returns

\\XooaSDK\\PendingTransactionResponse


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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\QueryResponse


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

\\XooaSDK\\exception\\XooaApiException
:   

#### Returns

\\XooaSDK\\PendingTransactionResponse


==

### currentIdentity() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
currentIdentity() : \XooaSDK\IdentityResponse
```

*Gets the detail about identity currently set*

#### Throws

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\IdentityResponse


==

### getIdentities() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getIdentities() : array<\XooaSDK\IdentityResponse>
```

*Get all identities from the identity registry
`Required permission`: manage identities (canManageIdentities=true)*

#### Throws

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

array\<\\XooaSDK\\IdentityResponse\> —

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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\IdentityResponse


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

\\XooaSDK\\exception\\XooaApiException
:   

#### Returns

\\XooaSDK\\PendingTransactionResponse


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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\IdentityResponse


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

\\XooaSDK\\exception\\XooaApiException
:   

#### Returns

\\XooaSDK\\PendingTransactionResponse


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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\IdentityResponse


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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\DeleteResponse


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

\\XooaSDK\\exception\\XooaApiException
:   

#### Returns

\\XooaSDK\\PendingTransactionResponse


==

### getCurrentBlock() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getCurrentBlock() : \XooaSDK\CurrentBlockResponse
```

*Use this function to Get the block number and hashes of current (highest) block in the network*

#### Throws

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\CurrentBlockResponse


==

### getCurrentBlockAsync() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
getCurrentBlockAsync() : \XooaSDK\PendingTransactionResponse
```

*Gets the detail about current block asynchronously*

#### Throws

\\XooaSDK\\exception\\XooaApiException
:   

#### Returns

\\XooaSDK\\PendingTransactionResponse


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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\BlockResponse


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

\\XooaSDK\\exception\\XooaApiException
:   

#### Returns

\\XooaSDK\\PendingTransactionResponse


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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\InvokeResponse


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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\QueryResponse


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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\IdentityResponse


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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\DeleteResponse


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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\CurrentBlockResponse


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

\\XooaSDK\\exception\\XooaApiException
:   
\\XooaSDK\\exception\\XooaRequestTimeoutException
:   

#### Returns

\\XooaSDK\\BlockResponse

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

\\XooaSDK\\exception\\XooaApiException
:   


==

### unsubscribe() {.public}

[](#source-view)

``` {.signature style="margin-right: 54px;"}
unsubscribe()
```

*Unsubscribes all events*
: 