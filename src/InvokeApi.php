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
use XooaSDK\response\WebCalloutResponse;

class InvokeApi {

    /**
     * Creates URL based on the parameters for invoke call.
     *
     * @param  string $calloutBaseUrl
     * @param  string $functionName
     * @param  string $apiToken
     * @param  string $args
     * @param  int $timeout
     *
     * @return InvokeResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    public function invoke($calloutBaseUrl, $functionName, $apiToken, $args, $timeout) {
        $url = $calloutBaseUrl . "/invoke/" . $functionName . "?timeout=" . $timeout;
        // $logger->debug("in invoke method->InvokeApi.php");
        return $this->callInvokeApi($apiToken, $url, $args);
    }

    /**
     * Creates URL based on the parameters for asynchronous invoke call.
     *
     * @param  string $calloutBaseUrl
     * @param  string $functionName
     * @param  string $apiToken
     * @param  string $args
     *
     * @return PendingTransactionResponse
     * 
     * @throws XooaApiException
     */
    public function invokeAsync($calloutBaseUrl, $functionName, $apiToken, $args) {
        $url = $calloutBaseUrl . "/invoke/" . $functionName . "?async=true";
        return $this->callInvokeApiAsync($apiToken, $url, $args);
    }

    /**
     * callInvokeApi
     *
     * @param  string $apiToken
     * @param  string $url
     * @param  string $args
     *
     * @return InvokeResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    private function callInvokeApi($apiToken, $url, $args) {
        // $logger->debug("in callInvokeApi method->InvokeApi.php");
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
            $invokeResponse = new InvokeResponse();
            $invokeResponse->setTransactionId($response->getResponseText()["txId"]);
            $invokeResponse->setPayload($response->getResponseText()["payload"]);
            return $invokeResponse;
        }
    }

    /**
     * callInvokeApiAsync
     *
     * @param  string $apiToken
     * @param  string $url
     * @param  string $args
     *
     * @return PendingTransactionResponse
     * 
     * @throws XooaApiException
     */
    private function callInvokeApiAsync($apiToken, $url, $args) {
        $callout = new WebService($apiToken);
        $response = $callout->makeQueryOrInvokeCall($url, $args);

        if ($response->getResponseCode() >= 400 && $response->getResponseCode() < 500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response.getResponseCode());
            $apiException->setErrorMessage($response.getResponseText());

            throw $apiException;
        } else {
            $pendingTransactionResponse = new PendingTransactionResponse();
            $pendingTransactionResponse->setResultUrl($response->getResponseText()["resultURL"]);
            $pendingTransactionResponse->setResultId($response->getResponseText()["resultId"]);
            return $pendingTransactionResponse;
        }
    }
}
?>