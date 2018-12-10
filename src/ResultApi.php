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
use XooaSDK\exception\XooaApiException;
use XooaSDK\exception\XooaRequestTimeoutException;
use XooaSDK\response\InvokeResponse;
use XooaSDK\response\QueryResponse;
use XooaSDK\response\IdentityResponse;
use XooaSDK\response\CurrentBlockResponse;
use XooaSDK\response\BlockResponse;
use XooaSDK\response\DeleteResponse;
use XooaSDK\WebService;

class ResultApi {
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
    public function getResultForInvoke($calloutBaseUrl, $apiToken, $resultId) {
        $url = $calloutBaseUrl . "/results/" . $resultId;

        $callout = new WebService($apiToken);
        $response = $callout->makeResultCall($url, WebService::$REQUEST_METHOD_GET);

        if ($response->getResponseCode() >= 400 && $response->getResponseCode() < 500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;

        } else if ($response->getResponseCode() == 202) {             
            XooaClient::$log->notice('Timeout Exception occured');
            $timeoutException = new XooaRequestTimeoutException();
            $timeoutException->setResultUrl($response->getResponseText()["resultURL"]);
            $timeoutException->setResultId($response->getResponseText()["resultId"]);
            throw $timeoutException;
            
        } else {
            $invokeResponse = new InvokeResponse();
            $invokeResponse->setTransactionId($response->getResponseText()["result"]["txId"]);
            $invokeResponse->setPayload($response->getResponseText()["result"]["payload"]);
            XooaClient::$log->info($invokeResponse);
            return $invokeResponse;
        }
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
    public function getResultForQuery($calloutBaseUrl, $apiToken, $resultId) {
        $url = $calloutBaseUrl . "/results/" . $resultId;

        $callout = new WebService($apiToken);
        $response = $callout->makeResultCall($url, WebService::$REQUEST_METHOD_GET);

        if ($response->getResponseCode() >= 400 && $response->getResponseCode() < 500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;

        } else if ($response->getResponseCode() == 202) {             
            XooaClient::$log->notice('Timeout Exception occured');
            $timeoutException = new XooaRequestTimeoutException();
            $timeoutException->setResultUrl($response->getResponseText()["resultURL"]);
            $timeoutException->setResultId($response->getResponseText()["resultId"]);
            throw $timeoutException;
            
        } else {
            $queryResponse = new QueryResponse();
            $queryResponse->setPayload($response->getResponseText()["result"]["payload"]);
            XooaClient::$log->info($queryResponse);
            return $queryResponse;
        }
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
    public function getResultForIdentity($calloutBaseUrl, $apiToken, $resultId) {
        $url = $calloutBaseUrl . "/results/" . $resultId;

        $callout = new WebService($apiToken);
        $response = $callout->makeResultCall($url, WebService::$REQUEST_METHOD_GET);

        if ($response->getResponseCode() >= 400 && $response->getResponseCode() < 500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;

        } else if ($response->getResponseCode() == 202) {             
            XooaClient::$log->notice('Timeout Exception occured');
            $timeoutException = new XooaRequestTimeoutException();
            $timeoutException->setResultUrl($response->getResponseText()["resultURL"]);
            $timeoutException->setResultId($response->getResponseText()["resultId"]);
            throw $timeoutException;
            
        } else {
            $identityResponse = new IdentityResponse();
            $identityResponse->setIdentityName($response->getResponseText()["result"]["IdentityName"]);
            $identityResponse->setAccessType($response->getResponseText()["result"]["Access"]);
            $identityResponse->setCanManageIdentities($response->getResponseText()["result"]["canManageIdentities"]);
            $identityResponse->setCreatedAt($response->getResponseText()["result"]["createdAt"]);
            $identityResponse->setApiToken($response->getResponseText()["result"]["ApiToken"]);
            $identityResponse->setId($response->getResponseText()["result"]["Id"]);
            $identityResponse->setAttrs($response->getResponseText()["result"]["Attrs"]);
            $identityResponse->setAppId($response->getResponseText()["result"]["AppId"]);
            $identityResponse->setAppName($response->getResponseText()["result"]["AppName"]);
            XooaClient::$log->info($identityResponse);
            return $identityResponse;
        }
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
    public function getResultForDeleteIdentity($calloutBaseUrl, $apiToken, $resultId) {
        $url = $calloutBaseUrl . "/results/" . $resultId;

        $callout = new WebService($apiToken);
        $response = $callout->makeResultCall($url, WebService::$REQUEST_METHOD_GET);

        if ($response->getResponseCode() >= 400 && $response->getResponseCode() < 500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;

        } else if ($response->getResponseCode() == 202) {             
            XooaClient::$log->notice('Timeout Exception occured');
            $timeoutException = new XooaRequestTimeoutException();
            $timeoutException->setResultUrl($response->getResponseText()["resultURL"]);
            $timeoutException->setResultId($response->getResponseText()["resultId"]);
            throw $timeoutException;
            
        } else {
            $deleteResponse = new DeleteResponse();
            $deleteResponse->setDeleted($response->getResponseText()["result"]["deleted"]);
            XooaClient::$log->info($deleteResponse);
            return $deleteResponse;
        }
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
    public function getResultForCurrentBlock($calloutBaseUrl, $apiToken, $resultId) {
        $url = $calloutBaseUrl . "/results/" . $resultId;

        $callout = new WebService($apiToken);
        $response = $callout->makeResultCall($url, WebService::$REQUEST_METHOD_GET);

        if ($response->getResponseCode() >= 400 && $response->getResponseCode() < 500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;

        } else if ($response->getResponseCode() == 202) {             
            XooaClient::$log->notice('Timeout Exception occured');
            $timeoutException = new XooaRequestTimeoutException();
            $timeoutException->setResultUrl($response->getResponseText()["resultURL"]);
            $timeoutException->setResultId($response->getResponseText()["resultId"]);
            throw $timeoutException;
            
        } else {
            $currentBlockResponse = new CurrentBlockResponse();
            $currentBlockResponse->setCurrentBlockHash($response->getResponseText()["result"]["currentBlockHash"]);
            $currentBlockResponse->setPreviousBlockHash($response->getResponseText()["result"]["previousBlockHash"]);
            $currentBlockResponse->setBlockNumber($response->getResponseText()["result"]["blockNumber"]);
            XooaClient::$log->info($currentBlockResponse);
            return $currentBlockResponse;
        }
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
    public function getResultForBlockByNumber($calloutBaseUrl, $apiToken, $resultId) {
        $url = $calloutBaseUrl . "/results/" . $resultId;

        $callout = new WebService($apiToken);
        $response = $callout->makeResultCall($url, WebService::$REQUEST_METHOD_GET);

        if ($response->getResponseCode() >= 400 && $response->getResponseCode() < 500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;

        } else if ($response->getResponseCode() == 202) {             
            XooaClient::$log->notice('Timeout Exception occured');
            $timeoutException = new XooaRequestTimeoutException();
            $timeoutException->setResultUrl($response->getResponseText()["resultURL"]);
            $timeoutException->setResultId($response->getResponseText()["resultId"]);
            throw $timeoutException;
            
        } else {
            $blockResponse = new BlockResponse();
            $blockResponse->setDataHash($response->getResponseText()["result"]["data_hash"]);
            $blockResponse->setPreviousHash($response->getResponseText()["result"]["previous_hash"]);
            $blockResponse->setNumberOfTransactions($response->getResponseText()["result"]["numberOfTransactions"]);
            $blockResponse->setBlockNumber($response->getResponseText()["result"]["blockNumber"]);
            XooaClient::$log->info($blockResponse);
            return $blockResponse;
        }
    }

    /**
     * Gets the result for transaction pending request
     *
     * @param  string $resultId
     *
     * @return TransactionResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    public function getResultForTransaction($calloutBaseUrl, $apiToken, $resultId) {
        $url = $calloutBaseUrl . "/results/" . $resultId;

        $callout = new WebService($apiToken);
        $response = $callout->makeResultCall($url, WebService::$REQUEST_METHOD_GET);

        if ($response->getResponseCode() >= 400 && $response->getResponseCode() < 500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;

        } else if ($response->getResponseCode() == 202) {             
            XooaClient::$log->notice('Timeout Exception occured');
            $timeoutException = new XooaRequestTimeoutException();
            $timeoutException->setResultUrl($response->getResponseText()["resultURL"]);
            $timeoutException->setResultId($response->getResponseText()["resultId"]);
            throw $timeoutException;
            
        } else {
            $transactionResponse = new TransactionResponse();
            $transactionResponse->setTxid($response->getResponseText()["result"]["txid"]);
            $transactionResponse->setCreatedt($response->getResponseText()["result"]["createdt"]);
            $transactionResponse->setSmartcontract($response->getResponseText()["result"]["smartcontract"]);
            $transactionResponse->setCreator_msp_id($response->getResponseText()["result"]["creator_msp_id"]);
            $transactionResponse->setEndorser_msp_id($response->getResponseText()["result"]["endorser_msp_id"]);
            $transactionResponse->setType($response->getResponseText()["result"]["type"]);
            $transactionResponse->setRead_set($response->getResponseText()["result"]["read_set"]);
            $transactionResponse->setWrite_set($response->getResponseText()["result"]["write_set"]);
            XooaClient::$log->info($transactionResponse);
            return $transactionResponse;
        }
    }
}