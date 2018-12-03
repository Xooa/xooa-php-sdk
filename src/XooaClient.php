<?php
/**
 * PHP SDK for Xooa
 * 
 * Copyright 2018 Xooa
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except
 * in compliance with the License. You may obtain a copy of the License at:
 * 
 * http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License
 * for the specific language governing permissions and limitations under the License.
 * 
 * Author: Arisht Jain
 */

    namespace XooaSDK;
    use XooaSDK\BlockchainApi;
    use XooaSDK\IdentityApi;
    use XooaSDK\InvokeApi;
    use XooaSDK\QueryApi;
    use XooaSDK\ResultApi;
    use XooaSDK\EventsApi;
    use XooaSDK\WebService;
    use XooaSDK\exception\XooaApiException;
    use XooaSDK\exception\XooaRequestTimeoutException;

    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    /**
     * This is the base class of PHP SDK.
     * This class contains all the public functions available by SDK.
     */
    class XooaClient {
        
        /** @var string Should contain a Xooa URl to send APIs to if not set by User*/
        private static  $DEFAULT_CALLOUT_BASE_URL = "https://api.xooa.com/api/v1";
        private static  $DEFAULT_SOCKET_URL = "https://api.xooa.com/";
        
        /** @var string Should contain a Xooa API Token to authorize requests */
        private $apiToken;

        /** @var string Should contain a Xooa URl to send APIs to */
        private $calloutBaseUrl;

        /** @var string Should contain a Xooa URl to send socket connection to */
        private $socketUrl;

        /** @var string Should contain an object of Xooa SDK webservice */
        private $webService;

        /** @var string Should contain logging level for SDK */
        public $loggingLevel;

        /** @var string Should contain an object of logger */
        public static $log;
        
        // -------- GETTERS AND SETTERS FOR CLASS VARIABLES ---------
        /**
         * Used to get a reference to XooaClient for calling the various methods defined
         *
         * @param apiToken Refers to the ApiToken from the deployed app on Xooa platform
         */
        public function __construct($apiToken) {
            $this::$log = new Logger('sdk');
            $this->setLoggingLevel("ERROR");
            $this->apiToken = $apiToken;
            
            // Creates a new instance of webservice class and sets it using the setter method
            $this->setWebService(new WebService($apiToken));
            $this::$log->debug('Object created');
            $this->calloutBaseUrl = $this::$DEFAULT_CALLOUT_BASE_URL;
            $this->socketUrl = $this::$DEFAULT_SOCKET_URL;
        }
        
        /**
         * Gets the API Token to use for calling the API
         *
         * @return string
         */
        public function getApiToken() {
            return $this->apiToken;
        }

        /**
         * Sets the base URl to send calls to
         *
         * @param  string $calloutBaseUrl
         *
         * @return void
         */
        public function setUrl($calloutBaseUrl): void {
            $this->calloutBaseUrl = $calloutBaseUrl;
            $this::$log->debug('URL set to '.$calloutBaseUrl);
        }

        /**
         * Gets the base URl to send calls to
         *
         * @return string
         */
        public function getUrl() {
            return $this->calloutBaseUrl;
        }

        /**
         * Sets the logging level for PHP SDK
         *
         * @param  string $loggingLevel
         *
         * @return void
         */
        public function setLoggingLevel($loggingLevel) {
            $this::$log->pushHandler(new StreamHandler(__DIR__.'/log.log', $loggingLevel));
            $this::$log->debug('Logging level set to '.$loggingLevel);
        }

        /**
         * Sets the object of SDK WebService
         *
         * @param  WebService $webService
         *
         * @return void
         */
        public function setWebService($webService): void {
            $this->webService = $webService;
        }
    

        // -------- CLASS METHODS ---------

        /**
         * Provides a way to validate the ApiToken via a Https call
         *
         * @return true - if valid
         * @throws XooaApiException - if invalid
         */
        public function validate() {
            $this::$log->debug('XooaClient::validate() called');
            if ($this->calloutBaseUrl == null) {
                $this->calloutBaseUrl = $this::$DEFAULT_CALLOUT_BASE_URL;
            }
            $this::$log->debug('calloutbaseURL set to: '.$this->calloutBaseUrl);
            $response = $this->webService->validateDetails($this->calloutBaseUrl);

            if ($response->getResponseCode() != 200) {
                $apiException = new XooaApiException();
                $apiException->setErrorCode($response->getResponseCode());
                $apiException->setErrorMessage($response->getResponseText());

                throw $apiException;
            } else {
                $response = $response->getResponseText();
                if (isset($response["Id"]) && $response["Id"]!= null) {
                    $this::$log->info('Validation successful');
                    return true;
                } else {
                    $this::$log->warning('Validation unsuccessful');
                    return false;
                }
            }
        }

        // -------- INVOKE METHODS ---------

        /**
         * Invokes the smart contract function
         * 
         * @param functionName
         * @param args - optional
         * @param timeout - optional
         * 
         * @return InvokeResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function invoke($functionName, $args=[], $timeout=3000) {
            $this::$log->debug('XooaClient::invoke() called');
            $invokeApi = new InvokeApi();
            return $invokeApi->invoke($this->calloutBaseUrl, $functionName, $this->apiToken, $args, $timeout);
        }

        /**
         * Invokes the smart contract function asynchronously
         * 
         * @param functionName
         * @param args - optional
         * 
         * @return PendingTransactionResponse
         * 
         * @throws XooaApiException
         */
        public function invokeAsync($functionName, $args=[]) {
            $this::$log->debug('XooaClient::invokeAsync() called');
            $invokeApi = new InvokeApi();
            return $invokeApi->invokeAsync($this->calloutBaseUrl, $functionName, $this->apiToken, $args);
        }

        // -------- QUERY METHODS ---------

        /**
         * Queries the smart contract
         * 
         * @param functionName
         * @param args
         * @param timeout
         * 
         * @return QueryResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function query($functionName, $args=[], $timeout=3000) {
            $this::$log->debug('XooaClient::query() called');
            $queryApi = new QueryApi();
            return $queryApi->query($this->calloutBaseUrl, $functionName, $this->apiToken, $args, $timeout);
        }

        /**
         * Queries the smart contract asynchronously
         * 
         * @param functionName
         * @param args
         * 
         * @return PendingTransactionResponse
         * 
         * @throws XooaApiException
         */
        public function queryAsync($functionName, $args=[]) {
            $this::$log->debug('XooaClient::queryAsync() called');
            $queryApi = new QueryApi();
            return $queryApi->queryAsync($this->calloutBaseUrl, $functionName, $this->apiToken, $args);
        }
        // -------- IDENTITY METHODS ---------
        
        /**
         * Gets the detail about identity currently set
         *
         * @return IdentityResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getCurrentIdentity() {
            $this::$log->debug('XooaClient::getCurrentIdentity() called');
            $identityApi = new IdentityApi();
            return $identityApi->getCurrentIdentity($this->calloutBaseUrl, $this->apiToken);
        }

        /**
         * Gets details about all the identities
         *
         * @return [] IdentityResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getIdentities() {
            $this::$log->debug('XooaClient::getIdentities() called');
            $identityApi = new IdentityApi();
            return $identityApi->getIdentities($this->calloutBaseUrl, $this->apiToken);
        }
        
        /**
         * Enrolls a new identity
         *
         * @param  json $identityRequest
         * @param  int $timeout
         *
         * @return IdentityResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function enrollIdentity($identityRequest, $timeout=3000) {
            $this::$log->debug('XooaClient::enrollIdentity() called');
            $identityApi = new IdentityApi();
            return $identityApi->enrollIdentity($this->calloutBaseUrl, $this->apiToken, $identityRequest, $timeout);
        }
        
        /**
         * Enrolls a new identity asynchronously
         *
         * @param  json $identityRequest
         *
         * @return PendingTransactionResponse
         * 
         * @throws XooaApiException
         */
        public function enrollIdentityAsync($identityRequest) {
            $this::$log->debug('XooaClient::enrollIdentityAsync() called');
            $identityApi = new IdentityApi();
            return $identityApi->enrollIdentityAsync($this->calloutBaseUrl, $this->apiToken, $identityRequest);
        }
        
        /**
         * Regenerates Identity API token
         *
         * @param  string $identityId
         * @param  int $timeout
         *
         * @return IdentityResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function regenerateIdentityApiToken($identityId, $timeout=3000) {
            $this::$log->debug('XooaClient::regenerateIdentityApiToken() called');
            $identityApi = new IdentityApi();
            return $identityApi->regenerateIdentityApiToken($this->calloutBaseUrl, $this->apiToken, $identityId, $timeout);
        }
        
        /**
         * Regenerates Identity API token asynchronously
         *
         * @param  string $identityId
         *
         * @return PendingTransactionResponse
         * 
         * @throws XooaApiException
         */
        public function regenerateIdentityApiTokenAsync($identityId) {
            $this::$log->debug('XooaClient::regenerateIdentityApiTokenAsync() called');
            $identityApi = new IdentityApi();
            return $identityApi->regenerateIdentityApiTokenAsync($this->calloutBaseUrl, $this->apiToken, $identityId);
        }
        
        /**
         * Gets the details about identityID 
         *
         * @param  string $identityId
         * @param  int $timeout
         *
         * @return IdentityResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getIdentity($identityId, $timeout=3000) {
            $this::$log->debug('XooaClient::getIdentity() called');
            $identityApi = new IdentityApi();
            return $identityApi->getIdentity($this->calloutBaseUrl, $this->apiToken, $identityId, $timeout);
        }
        
        /**
         * Deletes the given identity
         *
         * @param  string $identityId
         * @param  int $timeout
         *
         * @return DeleteResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function deleteIdentity($identityId, $timeout=3000) {
            $this::$log->debug('XooaClient::deleteIdentity() called');
            $identityApi = new IdentityApi();
            return $identityApi->deleteIdentity($this->calloutBaseUrl, $this->apiToken, $identityId, $timeout);
        }
        
        /**
         * Deletes the given identity asynchronously
         *
         * @param  string $identityId
         *
         * @return PendingTransactionResponse
         * 
         * @throws XooaApiException
         */
        public function deleteIdentityAsync($identityId) {
            $this::$log->debug('XooaClient::deleteIdentityAsync() called');
            $identityApi = new IdentityApi();
            return $identityApi->deleteIdentityAsync($this->calloutBaseUrl, $this->apiToken, $identityId);
        }

        // -------- BLOCKCHAIN METHODS ---------
        
        /**
         * Gets the detail about current block
         *
         * @return CurrentBlockResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getCurrentBlock() {
            $this::$log->debug('XooaClient::getCurrentBlock() called');
            $blockchainApi = new BlockchainApi();
            return $blockchainApi->getCurrentBlock($this->calloutBaseUrl, $this->apiToken);
        }
        
        /**
         * Gets the detail about current block asynchronously
         *
         * @return PendingTransactionResponse
         * 
         * @throws XooaApiException
         */
        public function getCurrentBlockAsync() {
            $this::$log->debug('XooaClient::getCurrentBlockAsync() called');
            $blockchainApi = new BlockchainApi();
            return $blockchainApi->getCurrentBlockAsync($this->calloutBaseUrl, $this->apiToken);
        }
        
        /**
         * Gets the detail about given block number 
         *
         * @param  int $blockNumber
         *
         * @return BlockResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getBlockByNumber($blockNumber) {
            $this::$log->debug('XooaClient::getBlockByNumber() called');
            $blockchainApi = new BlockchainApi();
            return $blockchainApi->getBlockByNumber($this->calloutBaseUrl, $this->apiToken, $blockNumber);
        }
        
        /**
         * Gets the detail about given block number asynchronously
         *
         * @param  int $blockNumber
         *
         * @return PendingTransactionResponse
         * 
         * @throws XooaApiException
         */
        public function getBlockByNumberAsync($blockNumber) {
            $this::$log->debug('XooaClient::getBlockByNumberAsync() called');
            $blockchainApi = new BlockchainApi();
            return $blockchainApi->getBlockByNumberAsync($this->calloutBaseUrl, $this->apiToken, $blockNumber);
        }
        
        /**
         * Gets the detail about given transaction id
         *
         * @param  string $transactionId
         *
         * @return TransactionResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getTransactionByTransactionId($transactionId) {
            $this::$log->debug('XooaClient::getTransactionByTransactionId() called');
            $blockchainApi = new BlockchainApi();
            return $blockchainApi->getTransactionByTransactionId($this->calloutBaseUrl, $this->apiToken, $transactionId);
        }
        
        /**
         * Gets the detail about given transaction id asynchronously
         *
         * @param  string $transactionId
         *
         * @return PendingTransactionResponse
         * 
         * @throws XooaApiException
         */
        public function getTransactionByTransactionIdAsync($transactionId) {
            $this::$log->debug('XooaClient::getTransactionByTransactionIdAsync() called');
            $blockchainApi = new BlockchainApi();
            return $blockchainApi->getTransactionByTransactionIdAsync($this->calloutBaseUrl, $this->apiToken, $transactionId);
        }

        // -------- RESULT METHODS ---------
        
        /**
         * Gets the result for invoke pending request
         *
         * @param  string $resultId
         *
         * @return InvokeResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getResultForInvoke($resultId) {
            $this::$log->debug('XooaClient::getResultForInvoke() called');
            $resulApi = new ResultApi();
            return $resulApi->getResultForInvoke($this->calloutBaseUrl, $this->apiToken, $resultId);
        }
        
        /**
         * Gets the result for query pending request
         *
         * @param  string $resultId
         *
         * @return QueryResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getResultForQuery($resultId) {
            $this::$log->debug('XooaClient::getResultForQuery() called');
            $resulApi = new ResultApi();
            return $resulApi->getResultForQuery($this->calloutBaseUrl, $this->apiToken, $resultId);
        }
        
        /**
         * Gets the result for identity pending request
         *
         * @param  string $resultId
         *
         * @return IdentityResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getResultForIdentity($resultId) {
            $this::$log->debug('XooaClient::getResultForIdentity() called');
            $resulApi = new ResultApi();
            return $resulApi->getResultForIdentity($this->calloutBaseUrl, $this->apiToken, $resultId);
        }
        
        /**
         * Gets the result for delete identity pending request
         *
         * @param  string $resultId
         *
         * @return DeleteResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getResultForDeleteIdentity($resultId) {
            $this::$log->debug('XooaClient::getResultForDeleteIdentity() called');
            $resulApi = new ResultApi();
            return $resulApi->getResultForDeleteIdentity($this->calloutBaseUrl, $this->apiToken, $resultId);
        }
        
        /**
         * Gets the result for current block pending request
         *
         * @param  string $resultId
         *
         * @return CurrentBlockResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getResultForCurrentBlock($resultId) {
            $this::$log->debug('XooaClient::getResultForCurrentBlock() called');
            $resulApi = new ResultApi();
            return $resulApi->getResultForCurrentBlock($this->calloutBaseUrl, $this->apiToken, $resultId);
        }
        
        /**
         * Gets the result for block pending request
         *
         * @param  string $resultId
         *
         * @return BlockResponse
         * 
         * @throws XooaApiException
         * @throws XooaRequestTimeoutException
         */
        public function getResultForBlockByNumber($resultId) {
            $this::$log->debug('XooaClient::getResultForBlockByNumber() called');
            $resulApi = new ResultApi();
            return $resulApi->getResultForBlockByNumber($this->calloutBaseUrl, $this->apiToken, $resultId);
        }
        
        // Events function
        
        /**
         * Subscribes to certain events
         *
         * @param  string $regex
         * @param  callable $callbackOnEvent
         *
         * @return void
         * 
         * @throws XooaApiException
         */
        public function subscribeEvents($regex = "", callable $callbackOnEvent): void {
            if (ZEND_THREAD_SAFE) {
                $eventsApi = new EventsApi();
                $eventsApi->subscribe($this->socketUrl, $this->apiToken, $regex, $callbackOnEvent);
            } else {
                XooaClient::$log->error('Exception occured: Threads not configured.');
                $apiException = new XooaApiException();
                $apiException->setErrorCode(500);
                $apiException->setErrorMessage("Threads not configured.");
                throw $apiException;
            }
        }

        /**
         * Subscribes to all events
         * 
         * @param  callable $callbackOnEvent
         *
         * @return void
         * 
         * @throws XooaApiException
         */
        public function subscribeAllEvents(callable $callbackOnEvent): void {
            if (ZEND_THREAD_SAFE) {
                $eventsApi = new EventsApi();
                $eventsApi->subscribe($this->socketUrl, $this->apiToken, "", $callbackOnEvent);
            } else {
                XooaClient::$log->error('Exception occured: Threads not configured.');
                $apiException = new XooaApiException();
                $apiException->setErrorCode(500);
                $apiException->setErrorMessage("Threads not configured.");
                throw $apiException;
            }
        }

        /**
         * Unsubscribes all events
         *
         * @return void
         */
        public function unsubscribe(): void {
            $eventsApi = new EventsApi();
            $eventsApi->unsubscribe();
        }


    }

?>