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
            $invokeResponse->setTransactionId($response->getResponseText()["payload"]["txId"]);
            $invokeResponse->setPayload($response->getResponseText()["payload"]["payload"]);
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
            $queryResponse->setPayload($response->getResponseText()["payload"]);
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
            $identityResponse->setIdentityName($response->getResponseText()["IdentityName"]);
            $identityResponse->setAccessType($response->getResponseText()["Access"]);
            $identityResponse->setCanManageIdentities($response->getResponseText()["canManageIdentities"]);
            $identityResponse->setCreatedAt($response->getResponseText()["createdAt"]);
            $identityResponse->setApiToken($response->getResponseText()["ApiToken"]);
            $identityResponse->setId($response->getResponseText()["Id"]);
            $identityResponse->setAttrs($response->getResponseText()["Attrs"]);
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
            $deleteResponse->setDeleted($response->getResponseText()["deleted"]);
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
            $currentBlockResponse->setCurrentBlockHash($response->getResponseText()["payload"]["currentBlockHash"]);
            $currentBlockResponse->setPreviousBlockHash($response->getResponseText()["payload"]["previousBlockHash"]);
            $currentBlockResponse->setBlockNumber($response->getResponseText()["payload"]["blockNumber"]);
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
            $blockResponse->setDataHash($response->getResponseText()["payload"]["data_hash"]);
            $blockResponse->setPreviousHash($response->getResponseText()["payload"]["previous_hash"]);
            $blockResponse->setNumberOfTransactions($response->getResponseText()["payload"]["numberOfTransactions"]);
            $blockResponse->setBlockNumber($response->getResponseText()["payload"]["blockNumber"]);
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
            $transactionResponse->setTxid($response->getResponseText()["payload"]["txid"]);
            $transactionResponse->setCreatedt($response->getResponseText()["payload"]["createdt"]);
            $transactionResponse->setSmartcontract($response->getResponseText()["payload"]["smartcontract"]);
            $transactionResponse->setCreator_msp_id($response->getResponseText()["payload"]["creator_msp_id"]);
            $transactionResponse->setEndorser_msp_id($response->getResponseText()["payload"]["endorser_msp_id"]);
            $transactionResponse->setType($response->getResponseText()["payload"]["type"]);
            $transactionResponse->setRead_set($response->getResponseText()["payload"]["read_set"]);
            $transactionResponse->setWrite_set($response->getResponseText()["payload"]["write_set"]);
            return $transactionResponse;
        }
    }
}