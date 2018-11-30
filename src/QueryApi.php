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
use XooaSDK\response\PendingTransactionResponse;
use XooaSDK\response\QueryResponse;
use XooaSDK\response\WebCalloutResponse;

class QueryApi {

    /**
     * Queries the chaincode
     * 
     * @param functionName
     * @param args - optional
     * @param timeout - optional
     * 
     * @return QueryResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    public function query($calloutBaseUrl, $functionName, $apiToken, $args = [], $timeout=3000) {
        $url = $calloutBaseUrl . "/query/" . $functionName . "?timeout=" . $timeout;
        return $this->callQueryApi($apiToken, $url, $args);
    }

    /**
     * Queries the chaincode asynchronously
     * 
     * @param functionName
     * @param args - optional
     * 
     * @return PendingTransactionResponse
     * 
     * @throws XooaApiException
     */
    public function queryAsync($calloutBaseUrl, $functionName, $apiToken, $args = []) {
        $url = $calloutBaseUrl . "/query/" . $functionName . "?async=true";
        return $this->callQueryApiAsync($apiToken, $url, $args);
    }

    /**
     * callQueryApi
     *
     * @param  string $apiToken
     * @param  string $url
     * @param  string $args
     *
     * @return QueryResponse
     * 
     * @throws XooaRequestTimeoutException
     * @throws XooaApiException
     */
    private function callQueryApi($apiToken, $url, $args) {
        $callout = new WebService($apiToken);
        $response = $callout->makeQueryOrInvokeCall($url, $args);

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
     * callQueryApiAsync
     *
     * @param  string $apiToken
     * @param  string $url
     * @param  string $args
     *
     * @return PendingTransactionResponse
     * 
     * @throws XooaApiException
     */
    private function callQueryApiAsync($apiToken, $url, $args) {
        $callout = new WebService($apiToken);
        $response = $callout->makeQueryOrInvokeCall($url, $args);

        if ($response->getResponseCode() >= 400 && $response->getResponseCode() < 500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;

        } else {
            $pendingTransactionResponse = new PendingTransactionResponse();
            $pendingTransactionResponse->setResultUrl($response->getResponseText()["resultURL"]);
            $pendingTransactionResponse->setResultId($response->getResponseText()["resultId"]);
            return $pendingTransactionResponse;
        }
    }
}