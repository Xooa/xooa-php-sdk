<?php
/**
 * Xooa PHP SDK usage example
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

    require_once('../../../vendor/autoload.php');
    use XooaSDK\XooaClient;

    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    $log = new Logger('exampleApp');
    $log->pushHandler(new StreamHandler(__DIR__.'/log.log', "DEBUG"));

    $XooaClient = new XooaClient("<Xooa API Token>");
    $identityId1 = "";
    $identityId2 = "";
    $trxnId = "";
    $invokeResultID = "";
    $queryResultID = "";
    $identityResultID = "";
    $deleteIdentityResultID = "";
    $currentBlockResultID = "";
    $blockResultID = "";
    $transactionResultID = "";
    if($XooaClient->validate()) {

        // Calling invoke methods

        /**
         * The invoke function is used for submitting transaction for processing by the blockchain smart contract app
         * when the transaction payload need to be persisted into the Ledger (new block is mined).
         * Required permission: write ("Access":"rw")
         * "set" function is the part of the smartcontract provided in this example
         * */ 
        try {
            $log->debug('calling invoke method "set" with args "args1, args2"');
            $response = $XooaClient->invoke('set', ["args1","args2"], 3000);
            var_dump($response);
            $trxnId = $response->getTransactionId();
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * The invokeAsync function is used for submitting transaction for processing by the blockchain smart contract app aynchronously
         * when the transaction payload need to be persisted into the Ledger (new block is mined).
         * Required permission: write ("Access":"rw")
         * "set" function is the part of the smartcontract provided in this example
         * */
        try {
            $log->debug('calling invokeAsync method "set" with args "args1, args2"');
            $response = $XooaClient->invokeAsync('set', ["args1","args2"]);
            var_dump($response);
            $invokeResultID = $response->getResultId();
        } catch (Exception $e) {
            var_dump($e);
        }

        // Calling query methods

        /**
         * Query Blockchain data
         * The query function is used for querying (reading) a blockchain ledger using smart contract function.
	     * It must pass a function name already defined in your smart contract app which will process the query request.
	     * Required permission: read ("Access":"rw" or "Access":"r")
         * "get" function is the part of the smartcontract provided in this example
         * */
        try {
            $log->debug('calling query method "get" with args "args1"');
            $response = $XooaClient->query('get', ["args1"], 3000);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * The query function is used for querying (reading) a blockchain ledger using smart contract function asynchronously.
	     * It must pass a function name already defined in your smart contract app which will process the query request.
	     * Required permission: read ("Access":"rw" or "Access":"r")
         * "get" function is the part of the smartcontract provided in this example
         * */
        try {
            $log->debug('calling queryAsync method "get" with args "args1"');
            $response = $XooaClient->queryAsync('get', ["args1"]);
            var_dump($response);
            $queryResultID = $response->getResultId();
        } catch (Exception $e) {
            var_dump($e);
        }

        // Calling identity methods

        /**
         * Gets the detail about identity currently set
         * no argument is required
         * */
        try {
            $log->debug('calling currentIdentity method');
            $response = $XooaClient->currentIdentity();
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * Get all identities from the identity registry
         * no argument is required
         * */
        try {
            $log->debug('calling getIdentities method');
            $response = $XooaClient->getIdentities();
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * The Enroll identity function is used to enroll new identities for the smart contract app. A success response includes the API Token generated for the identity. This API Token can be used to call API End points on behalf of the enrolled identity.
         * This function provides equivalent functionality to adding new identity manually using Xooa console, and identities added using this function will appear, and can be managed, using Xooa console under the identities tab of the smart contract app
         * identityRequest is required argument
         * */
        try {
            $log->debug('calling enrollIdentity method with args as identityRequest');
            $identityRequest = '{
                "IdentityName": "string",
                "Access": "r",
                "Attrs": [
                    {
                    "name": "string",
                    "ecert": true,
                    "value": "string"
                    }
                ],
                "canManageIdentities": true
                }';
            $response = $XooaClient->enrollIdentity($identityRequest);
            $identityId1 = $response->getId();

            $identityRequest = '{
                "IdentityName": "string1",
                "Access": "r",
                "Attrs": [
                    {
                    "name": "string",
                    "ecert": true,
                    "value": "string"
                    }
                ],
                "canManageIdentities": true
                }';
            $response = $XooaClient->enrollIdentity($identityRequest);
            $identityId2 = $response->getId();
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * The Enroll identity function is used to enroll new identities for the smart contract app asynchronously. A success response includes the API Token generated for the identity. This API Token can be used to call API End points on behalf of the enrolled identity.
         * This function provides equivalent functionality to adding new identity manually using Xooa console, and identities added using this function will appear, and can be managed, using Xooa console under the identities tab of the smart contract app
         * `Required permission`: manage identities (canManageIdentities=true)
         * */
        try {
            $log->debug('calling enrollIdentityAsync method with args as identityRequest');
            $identityRequest = '{
                "IdentityName": "string2",
                "Access": "r",
                "Attrs": [
                    {
                    "name": "string",
                    "ecert": true,
                    "value": "string"
                    }
                ],
                "canManageIdentities": true
                }';
            $response = $XooaClient->enrollIdentityAsync($identityRequest);
            var_dump($response);
            $identityResultID = $response->getResultId();
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * Generates new identity API Token
         * identity ID is required argument
         * */
        try {
            $log->debug('calling regenerateIdentityApiToken method with identity ID of identity generated in enrollIdentity method call');
            $response = $XooaClient->regenerateIdentityApiToken($identityId1);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * Generates new identity API Token asynchronously
         * identity ID is required argument
         * */
        try {
            $log->debug('calling regenerateIdentityApiTokenAsync method with identity ID of identity generated in enrollIdentity method call');
            $response = $XooaClient->regenerateIdentityApiTokenAsync($identityId1);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * Get the specified identity from the identity registry
         * identity ID is required argument
         * */
        try {
            $log->debug('calling getIdentity method with identity ID of identity generated in enrollIdentity method call');
            $response = $XooaClient->getIdentity($identityId1);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * Deletes an identity.
         * identity ID is required argument
         * */
        try {
            $log->debug('calling deleteIdentity method with identity ID of identity generated in enrollIdentity method call');
            $response = $XooaClient->deleteIdentity($identityId1);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }
        
        /**
         * Deletes an identity asynchronously.
         * identity ID is required argument
         * */
        try {
            $log->debug('calling deleteIdentityAsync method with identity ID of identity generated in enrollIdentity method call');
            $response = $XooaClient->deleteIdentityAsync($identityId2);
            var_dump($response);
            $deleteIdentityResultID = $response->getResultId();
        } catch (Exception $e) {
            var_dump($e);
        }
        
        // Calling blockchain state methods

        /**
         * To get details about current block, call getCurrentBlock method
         * no argument is required
         * */
        try {
            $log->debug('calling getCurrentBlock method');
            $response = $XooaClient->getCurrentBlock();
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To get details about current block asynchronously, call getCurrentBlockAsync method
         * no argument is required
         * */
        try {
            $log->debug('calling getCurrentBlockAsync method');
            $response = $XooaClient->getCurrentBlockAsync();
            var_dump($response);
            $currentBlockResultID = $response->getResultId();
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To get details about a block, call getBlockByNumber method
         * block number is required argument
         * */
        try {
            $log->debug('calling getBlockByNumber method with "1" as block number');
            $response = $XooaClient->getBlockByNumber(1);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To get details about a block asynchronously, call getBlockByNumberAsync method
         * block number is required argument
         * */
        try {
            $log->debug('calling getBlockByNumberAsync method with "1" as block number');
            $response = $XooaClient->getBlockByNumberAsync(1);
            var_dump($response);
            $blockResultID = $response->getResultId();
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To get details about a block, call getTransactionByTransactionId method
         * transaction id is required argument
         * */
        try {
            $log->debug('calling getTransactionByTransactionId method with "trxnId" as transaction id');
            $response = $XooaClient->getTransactionByTransactionId($trxnId);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To get details about a block asynchronously, call getTransactionByTransactionIdAsync method
         * transaction id is required argument
         * */
        try {
            $log->debug('calling getTransactionByTransactionIdAsync method with "trxnId" as transaction id');
            $response = $XooaClient->getTransactionByTransactionIdAsync($trxnId);
            var_dump($response);
            $transactionResultID = $response->getResultId();
        } catch (Exception $e) {
            var_dump($e);
        }

        // Calling results methods

        /**
         * To get result for query pending request, call getResultForQuery method
         * resultId is required argument
         * */
        try {
            $log->debug('calling getResultForQuery method with resultId generated in queryAsync method call');
            $response = $XooaClient->getResultForQuery($queryResultID);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To get result for invoke pending request, call getResultForInvoke method
         * resultId is required argument
         * */
        try {
            $log->debug('calling getResultForInvoke method with resultId generated in invokeAsync method call');
            $response = $XooaClient->getResultForInvoke($invokeResultID);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To get result for identity pending request, call getResultForIdentity method
         * resultId is required argument
         * */
        try {
            $log->debug('calling getResultForIdentity method with resultId generated in enrollIdentityAsync method call');
            $response = $XooaClient->getResultForIdentity($identityResultID);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To get result for delete identity pending request, call getResultForDeleteIdentity method
         * resultId is required argument
         * */
        try {
            $log->debug('calling getResultForDeleteIdentity method with resultId generated in deleteIdentityAsync method call');
            $response = $XooaClient->getResultForDeleteIdentity($deleteIdentityResultID);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To get result for current block pending request, call getResultForCurrentBlock method
         * resultId is required argument
         * */
        try {
            $log->debug('calling getResultForCurrentBlock method with resultId generated in getCurrentBlockAsync method call');
            $response = $XooaClient->getResultForCurrentBlock($currentBlockResultID);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To get result for block pending request, call getResultForBlockByNumber method
         * resultId is required argument
         * */
        try {
            $log->debug('calling getResultForBlockByNumber method with resultId generated in getBlockByNumberAsync method call');
            $response = $XooaClient->getResultForBlockByNumber($blockResultID);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To get result for transaction pending request, call getResultForTransaction method
         * resultId is required argument
         * */
        try {
            $log->debug('calling getResultForTransaction method with resultId generated in getTransactionByTransactionIdAsync method call');
            $response = $XooaClient->getResultForTransaction($transactionResultID);
            var_dump($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        // Events function

        function callBackForEvent($event){
            var_dump("in callback");
            var_dump($event);
        }

        /**
         * To subscribe to all events, call subscribeAllEvents method
         * callBackForEvent is required argument
         * */
        try {
            $log->debug('calling subscribeAllEvents method with "callBackForEvent" as arguement');
            $callBackForEvent = 'callBackForEvent';
            $XooaClient->subscribeAllEvents($callBackForEvent);
        } catch (Exception $e) {
            var_dump($e);
        }

        /**
         * To unsubscribe from any events, call unsubscribe method
         * calling unsubscribe method
         * no arguments are required
         * */
        $XooaClient->unsubscribe();


    } else {
        $log->debug('Validation unsuccessful. Invalid API Token.');
        echo "Invalid API Token.";
    }

?>