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

namespace XooaSDK\exception;
class XooaRequestTimeoutException extends \Exception {
    private $resultUrl;
    private $resultId;

    /**
     * Gets the result URL from XooaRequestTimeoutException
     *
     * @return string
     */
    public function getResultUrl(): string {
        return $this->resultUrl;
    }

    /**
     * Sets the result URL to XooaRequestTimeoutException
     *
     * @param  string $resultUrl
     *
     * @return void
     */
    public function setResultUrl($resultUrl): void {
        $this->resultUrl = $resultUrl;
    }

    /**
     * Gets the result ID from XooaRequestTimeoutException
     *
     * @return string
     */
    public function getResultId(): string {
        return $this->resultId;
    }

    /**
     * Sets the result ID to XooaRequestTimeoutException
     *
     * @param  string $resultId
     *
     * @return void
     */
    public function setResultId($resultId): void {
        $this->resultId = $resultId;
    }
}

?>