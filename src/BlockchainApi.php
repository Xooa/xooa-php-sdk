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
use XooaSDK\response\BlockResponse;
use XooaSDK\response\CurrentBlockResponse;
use XooaSDK\response\TransactionResponse;
use XooaSDK\response\PendingTransactionResponse;
use XooaSDK\WebService;

class BlockchainApi {

    /**
     * Gets the detail about current block
     *
     * @return CurrentBlockResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    public function getCurrentBlock($calloutBaseUrl, $apiToken) {
        $url = $calloutBaseUrl . "/block/current";
        return $this->callBlockchainApi($apiToken, $url, WebService::$RequestMethodGet);
    }

    /**
     * Gets the detail about current block asynchronously
     *
     * @return PendingTransactionResponse
     * 
     * @throws XooaApiException
     */
    public function getCurrentBlockAsync($calloutBaseUrl, $apiToken) {
        $url = $calloutBaseUrl . "/block/current?async=true";
        return $this->callBlockchainApiAsync($apiToken, $url, WebService::$RequestMethodGet);
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
    public function getBlockByNumber($calloutBaseUrl, $apiToken, $blockNumber) {
        $url = $calloutBaseUrl . "/block/" . $blockNumber;
        return $this->callBlockApi($apiToken, $url, WebService::$RequestMethodGet);
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
    public function getBlockByNumberAsync($calloutBaseUrl, $apiToken, $blockNumber) {
        $url = $calloutBaseUrl . "/block/" . $blockNumber . "?async=true";
        return $this->callBlockchainApiAsync($apiToken, $url, WebService::$RequestMethodGet);
    }

    /**
     * Gets the detail about given transaction id
     *
     * @param  int $transactionId
     *
     * @return BlockResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    public function getTransactionByTransactionId($calloutBaseUrl, $apiToken, $transactionId) {
        $url = $calloutBaseUrl . "/transactions/" . $transactionId;
        return $this->callTransactionApi($apiToken, $url, WebService::$RequestMethodGet);
    }

    /**
     * Gets the detail about given transaction id asynchronously
     *
     * @param  int $transactionId
     *
     * @return PendingTransactionResponse
     * 
     * @throws XooaApiException
     */
    public function getTransactionByTransactionIdAsync($calloutBaseUrl, $apiToken, $transactionId) {
        $url = $calloutBaseUrl . "/transactions/" . $transactionId . "?async=true";
        return $this->callBlockchainApiAsync($apiToken, $url, WebService::$RequestMethodGet);
    }

    private function callBlockchainApi($apiToken, $url, $requestMethod) {
        $callout = new WebService($apiToken);
        $response = $callout->makeBlockchainCall($url, $requestMethod);

        if ($response->getResponseCode()>=400 && $response->getResponseCode()<500) {
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
            $currentBlockResponse->setCurrentBlockHash($response->getResponseText()["currentBlockHash"]);
            $currentBlockResponse->setPreviousBlockHash($response->getResponseText()["previousBlockHash"]);
            $currentBlockResponse->setBlockNumber($response->getResponseText()["blockNumber"]);
            XooaClient::$log->info($currentBlockResponse);
            return $currentBlockResponse;
        }
    }

    /**
     * callBlockApi
     *
     * @param  string $apiToken
     * @param  string $url
     * @param  string $requestMethod
     *
     * @return BlockResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    private function callBlockApi($apiToken, $url, $requestMethod) {
        $callout = new WebService($apiToken);
        $response = $callout->makeBlockchainCall($url, $requestMethod);

        if ($response->getResponseCode()>=400 && $response->getResponseCode()<500) {
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
            $blockResponse->setDataHash($response->getResponseText()["data_hash"]);
            $blockResponse->setPreviousHash($response->getResponseText()["previous_hash"]);
            $blockResponse->setNumberOfTransactions($response->getResponseText()["numberOfTransactions"]);
            $blockResponse->setBlockNumber($response->getResponseText()["blockNumber"]);
            XooaClient::$log->info($blockResponse);
            return $blockResponse;
        }
    }

    /**
     * callTransactionApi
     *
     * @param  string $apiToken
     * @param  string $url
     * @param  string $requestMethod
     *
     * @return BlockResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    private function callTransactionApi($apiToken, $url, $requestMethod) {
        $callout = new WebService($apiToken);
        $response = $callout->makeBlockchainCall($url, $requestMethod);

        if ($response->getResponseCode()>=400 && $response->getResponseCode()<500) {
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
            $transactionResponse->setTxid($response->getResponseText()["txid"]);
            $transactionResponse->setCreatedt($response->getResponseText()["createdt"]);
            $transactionResponse->setSmartcontract($response->getResponseText()["smartcontract"]);
            $transactionResponse->setCreatorMspId($response->getResponseText()["creator_msp_id"]);
            $transactionResponse->setEndorserMspId($response->getResponseText()["endorser_msp_id"]);
            $transactionResponse->setType($response->getResponseText()["type"]);
            $transactionResponse->setReadSet($response->getResponseText()["read_set"]);
            $transactionResponse->setWriteSet($response->getResponseText()["write_set"]);
            XooaClient::$log->info($transactionResponse);
            return $transactionResponse;
        }
    }

    /**
     * callBlockchainApiAsync
     *
     * @param  string $apiToken
     * @param  string $url
     * @param  string $requestMethod
     *
     * @return PendingTransactionResponse
     * 
     * @throws XooaApiException
     */
    private function callBlockchainApiAsync($apiToken, $url, $requestMethod) {
        $callout = new WebService($apiToken);
        $response = $callout->makeBlockchainCall($url, $requestMethod);

        if ($response->getResponseCode()>=400 && $response->getResponseCode()<500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;

        } else {
            $pendingTransactionResponse = new PendingTransactionResponse();
            $pendingTransactionResponse->setResultUrl($response->getResponseText()["resultURL"]);
            $pendingTransactionResponse->setResultId($response->getResponseText()["resultId"]);
            XooaClient::$log->info($pendingTransactionResponse);
            return $pendingTransactionResponse;
        }
    }
}
