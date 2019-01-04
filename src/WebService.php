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

use XooaSDK\response\WebCalloutResponse;
class WebService {

    public static $RequestMethodGet = "GET";
    public static $RequestMethodPost = "POST";
    public static $RequestMethodDelete = "DELETE";

    private $apiToken;

    // -------- CLASS CONSTRUCTORS ---------

    /**
     * @Constructor
     * @param apiToken ApiToken to be used in the HTTPS header
     * 
     * @return void
     */
    public function __construct($apiToken) {
        $this->apiToken = $apiToken;
    }

    // -------- PUBLIC CLASS METHODS ---------

    /**
     * Validate details for calling API
     *
     * @param  string $baseUrl
     *
     * @return WebCalloutResponse
     */
    public function validateDetails($baseUrl) {
        $calloutUrl = $baseUrl . "/identities/me";
        return $this->makeHttpCall($calloutUrl, $this::$RequestMethodGet, null);
    }

    /**
     * Creates request body structure to pass in API for invoke calls
     *
     * @param  string $calloutUrl
     * @param  string $args
     *
     * @return WebCalloutResponse
     */
    public function makeQueryOrInvokeCall($calloutUrl, $args) {
        $requestBody = null;
        if ($args != null) {
            // $requestBody = "{";
            // $requestBody .= "\"args\": ";
            $requestBody = "[";
            for ($i = 0; $i < sizeof($args); $i++) {
                $requestBody .= "\"";
                $requestBody .= $args[$i];
                $requestBody .= "\"";
                if ($i != sizeof($args) - 1) {
                    $requestBody .= ",";
                }
            }
            $requestBody .= "]";
            // $requestBody .= "}";
        }

        return $this->makeHttpCall($calloutUrl, $this::$RequestMethodPost, $requestBody);
    }

    // -------- PRIVATE CLASS METHODS ---------

    /**
     * Provides way to call the server
     *
     * @param string calloutUrl    The server url to be called
     * @param string requestMethod The type of Https method - GET, POST, DELETE, etc
     * @param string requestBody   The request body to be attached while making the call
     * 
     * @return WebCalloutResponse
     * 
     * @throws Exception
     */
    private function makeHttpCall($calloutUrl, $requestMethod, $requestBody) {
        try {
            $curl = curl_init();
            if ($requestMethod == "POST") {
                XooaClient::$log->debug('Request Body: '.$requestBody);
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $calloutUrl,
                    CURLOPT_POST => 1,
                    CURLOPT_POSTFIELDS => $requestBody,
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: bearer " . $this->apiToken
                    )
                ));
            } elseif ($requestMethod == "GET"){
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $calloutUrl.$requestBody,
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: bearer " . $this->apiToken
                    )
                ));
            } else {
                // DELETE method
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_CUSTOMREQUEST => "DELETE",
                    CURLOPT_URL => $calloutUrl,
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: bearer " . $this->apiToken
                    )
                ));
            }
            XooaClient::$log->debug('Going to call '.$calloutUrl);
            $resp = curl_exec($curl);
            $response = new WebCalloutResponse();
            $status = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
            // var_dump($resp);
            XooaClient::$log->debug("Response received: ".$resp);
            XooaClient::$log->debug("HTTP status: ".$status);
            $response->setResponseCode($status);
            $response->setResponseText(json_decode($resp, true));
            curl_close($curl);

            return $response;
        } catch (Exception $e) {
            XooaClient::$log->error($e);
            return $e;
        }
    }

    /**
     * makeIdentityCall
     *
     * @param  string $calloutUrl
     * @param  string $requestMethod
     * @param  string $requestString
     *
     * @return WebCalloutResponse
     */
    public function makeIdentityCall($calloutUrl, $requestMethod, $requestString) {
        return $this->makeHttpCall($calloutUrl, $requestMethod, $requestString);
    }

    /**
     * makeBlockchainCall
     *
     * @param  string $calloutUrl
     * @param  string $requestMethod
     *
     * @return voiWebCalloutResponsed
     */
    public function makeBlockchainCall($calloutUrl, $requestMethod) {
        return $this->makeHttpCall($calloutUrl, $requestMethod, null);
    }
    
    /**
     * makeResultCall
     *
     * @param  string $calloutUrl
     * @param  string $requestMethod
     *
     * @return WebCalloutResponse
     */
    public function makeResultCall($calloutUrl, $requestMethod) {
        return $this->makeHttpCall($calloutUrl, $requestMethod, null);
    }
}
