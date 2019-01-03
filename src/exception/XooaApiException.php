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

class XooaApiException extends \Exception {
    private $errorCode;
    private $errorMessage;

    /**
     * Gets the error code from XooaApiException
     *
     * @return int
     */
    public function getErrorCode(): int {
        return $this->errorCode;
    }

    /**
     * Gets the error code to XooaApiException
     *
     * @param  int $errorCode
     *
     * @return void
     */
    public function setErrorCode($errorCode): void {
        $this->errorCode = $errorCode;
    }

    /**
     * Gets the error message from XooaApiException
     *
     * @return string
     */
    public function getErrorMessage(): string {
        return $this->errorMessage;
    }

    /**
     * Sets the error message to XooaApiException
     *
     * @param  string $errorMessage
     *
     * @return void
     */
    public function setErrorMessage($errorMessage): void {
        $this->errorMessage = $errorMessage;
    }
}
