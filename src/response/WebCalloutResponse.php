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

namespace XooaSDK\response;

class WebCalloutResponse {
    private $responseCode;
    private $responseText;

    /**
     * getResponseCode
     *
     * @return int
     */
    public function getResponseCode(): int {
        return $this->responseCode;
    }

    /**
     * setResponseCode
     *
     * @param  string $responseCode
     *
     * @return void
     */
    public function setResponseCode($responseCode): void {
        $this->responseCode = $responseCode;
    }

    /**
     * getResponseText
     *
     */
    public function getResponseText() {
        return $this->responseText;
    }

    /**
     * setResponseText
     *
     * @param  string $responseText
     *
     * @return void
     */
    public function setResponseText($responseText): void {
        $this->responseText = $responseText;
    }
}
