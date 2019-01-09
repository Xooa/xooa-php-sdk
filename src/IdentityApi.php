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
use XooaSDK\response\IdentityResponse;
use XooaSDK\response\PendingTransactionResponse;
use XooaSDK\response\WebCalloutResponse;
use XooaSDK\response\DeleteResponse;
use XooaSDK\WebService;

class IdentityApi {

    /**
     * Gets the detail about identity currently set
     *
     * @return IdentityResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    public function currentIdentity($calloutBaseUrl, $apiToken) {
        $url = $calloutBaseUrl . "/identities/me";
        return $this->callIdentityApi($apiToken, $url, WebService::$RequestMethodGet, null);
    }

    /**
     * Gets details about all the identities
     *
     * @return [] IdentityResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    public function getIdentities($calloutBaseUrl, $apiToken) {
        $url = $calloutBaseUrl . "/identities/";
        return $this->callAllIdentitiesApi($apiToken, $url, WebService::$RequestMethodGet, null);
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
    public function enrollIdentity($calloutBaseUrl, $apiToken, $identityRequest, $timeout) {
        $url = $calloutBaseUrl . "/identities?timeout=" . $timeout;
        return $this->callIdentityApi($apiToken, $url, WebService::$RequestMethodPost, $identityRequest);
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
    public function enrollIdentityAsync($calloutBaseUrl, $apiToken, $identityRequest) {
        $url = $calloutBaseUrl . "/identities?async=true";
        return $this->callIdentityApiAsync($apiToken, $url, WebService::$RequestMethodPost, $identityRequest);
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
    public function regenerateIdentityApiToken($calloutBaseUrl, $apiToken, $identityId, $timeout) {
        $url = $calloutBaseUrl . "/identities/" . $identityId . "/regeneratetoken?timeout=" . $timeout;
        return $this->callIdentityApi($apiToken, $url, WebService::$RequestMethodPost, null);
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
    public function regenerateIdentityApiTokenAsync($calloutBaseUrl, $apiToken, $identityId) {
        $url = $calloutBaseUrl . "/identities/" . $identityId . "/regeneratetoken?async=true";
        return $this->callIdentityApiAsync($apiToken, $url, WebService::$RequestMethodPost, null);
    }

    /**
     * Gets the details abour identityID 
     *
     * @param  string $identityId
     * @param  int $timeout
     *
     * @return IdentityResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    public function getIdentity($calloutBaseUrl, $apiToken, $identityId, $timeout) {
        $url = $calloutBaseUrl . "/identities/" . $identityId . "?timeout=" . $timeout;
        return $this->callIdentityApi($apiToken, $url, WebService::$RequestMethodGet, null);
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
    public function deleteIdentity($calloutBaseUrl, $apiToken, $identityId, $timeout) {
        $url = $calloutBaseUrl . "/identities/" . $identityId . "?timeout=" . $timeout;
        return $this->callDeleteIdentityApi($apiToken, $url, WebService::$RequestMethodDelete, null);
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
    public function deleteIdentityAsync($calloutBaseUrl, $apiToken, $identityId) {
        $url = $calloutBaseUrl . "/identities/" . $identityId . "?async=true";
        return $this->callIdentityApiAsync($apiToken, $url, WebService::$RequestMethodDelete, null);
    }

    
    /**
     * callDeleteIdentityApi
     *
     * @param  string $apiToken
     * @param  string $url
     * @param  string $requestMethod
     * @param  string $requestString
     *
     * @return DeleteResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    private function callDeleteIdentityApi($apiToken, $url, $requestMethod, $requestString) {
        $callout = new WebService($apiToken);
        $response = $callout->makeIdentityCall($url, $requestMethod, $requestString);

        if ($response->getResponseCode()>=400 && $response->getResponseCode()<500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;
        } elseif ($response->getResponseCode() == 202) {             
            XooaClient::$log->notice('Timeout Exception occured');
            $timeoutException = new XooaRequestTimeoutException();
            $timeoutException->setResultUrl($response->getResponseText()["resultURL"]);
            $timeoutException->setResultId($response->getResponseText()["resultId"]);
            throw $timeoutException;
        } else {
            $deleteResponse = new DeleteResponse();
            $deleteResponse->setDeleted($response->getResponseText()["deleted"]);
            XooaClient::$log->info($deleteResponse);
            return $deleteResponse;
        }
    }

    /**
     * callIdentityApi
     *
     * @param  string $apiToken
     * @param  string $url
     * @param  string $requestMethod
     * @param  string $requestString
     *
     * @return IdentityResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    private function callIdentityApi($apiToken, $url, $requestMethod, $requestString) {
        $callout = new WebService($apiToken);
        $response = $callout->makeIdentityCall($url, $requestMethod, $requestString);

        if ($response->getResponseCode()>=400 && $response->getResponseCode()<500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;
        } elseif ($response->getResponseCode() == 202) {             
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
            $identityResponse->setId($response->getResponseText()["Id"]);
            $identityResponse->setAttrs($response->getResponseText()["Attrs"]);
            $identityResponse->setAppId($response->getResponseText()["AppId"]);
            $identityResponse->setAppName($response->getResponseText()["AppName"]);
            XooaClient::$log->info($identityResponse);
            return $identityResponse;
        }
    }

    /**
     * callIdentityApiAsync
     *
     * @param  string $apiToken
     * @param  string $url
     * @param  string $requestMethod
     * @param  string $requestString
     *
     * @return PendingTransactionResponse
     * 
     * @throws XooaApiException
     */
    private function callIdentityApiAsync($apiToken, $url, $requestMethod, $requestString) {
        $callout = new WebService($apiToken);
        $response = $callout->makeIdentityCall($url, $requestMethod, $requestString);

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

    /**
     * callAllIdentitiesApi
     *
     * @param  string $apiToken
     * @param  string $url
     * @param  string $requestMethod
     * @param  string $requestString
     *
     * @return IdentityResponse
     * 
     * @throws XooaApiException
     * @throws XooaRequestTimeoutException
     */
    private function callAllIdentitiesApi($apiToken, $url, $requestMethod, $requestString) {
        $callout = new WebService($apiToken);
        $response = $callout->makeIdentityCall($url, $requestMethod, $requestString);

        if ($response->getResponseCode()>=400 && $response->getResponseCode()<500) {
            XooaClient::$log->error('Exception occured: '.$response->getResponseText()["error"]);
            $apiException = new XooaApiException();
            $apiException->setErrorCode($response->getResponseCode());
            $apiException->setErrorMessage($response->getResponseText()["error"]);
            throw $apiException;
        } elseif ($response->getResponseCode() == 202) {             
            XooaClient::$log->notice('Timeout Exception occured');
            $timeoutException = new XooaRequestTimeoutException();
            $timeoutException->setResultUrl($response->getResponseText()["resultURL"]);
            $timeoutException->setResultId($response->getResponseText()["resultId"]);
            throw $timeoutException;
        } else {
            $response = $response->getResponseText();
            $identityArr = [];
            foreach ($response as $identity) {
                $identityResponse = new IdentityResponse();
                $identityResponse->setIdentityName($identity["IdentityName"]);
                $identityResponse->setAccessType($identity["Access"]);
                $identityResponse->setCanManageIdentities($identity["canManageIdentities"]);
                $identityResponse->setCreatedAt($identity["createdAt"]);
                $identityResponse->setId($identity["Id"]);
                $identityResponse->setAttrs($identity["Attrs"]);
                $identityResponse->setAppId($identity["AppId"]);
                $identityResponse->setAppName($identity["AppName"]);
                array_push($identityArr, $identityResponse);
            }
            XooaClient::$log->info($identityArr);
            return $identityArr;
        }
    }
}
