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

class CurrentBlockResponse {
    private $currentBlockHash;
    private $previousBlockHash;
    private $blockNumber;

    /**
     * getCurrentBlockHash
     *
     * @return string
     */
    public function getCurrentBlockHash(): string {
        return $this->currentBlockHash;
    }

    /**
     * setCurrentBlockHash
     *
     * @param  string $currentBlockHash
     *
     * @return void
     */
    public function setCurrentBlockHash($currentBlockHash) {
        $this->currentBlockHash = $currentBlockHash;
    }

    /**
     * getPreviousBlockHash
     *
     * @return string
     */
    public function getPreviousBlockHash(): string {
        return $this->previousBlockHash;
    }

    /**
     * setPreviousBlockHash
     *
     * @param  string $previousBlockHash
     *
     * @return void
     */
    public function setPreviousBlockHash($previousBlockHash) {
        $this->previousBlockHash = $previousBlockHash;
    }

    /**
     * getBlockNumber
     *
     * @return int
     */
    public function getBlockNumber(): int {
        return $this->blockNumber;
    }

    /**
     * setBlockNumber
     *
     * @param  int $blockNumber
     *
     * @return void
     */
    public function setBlockNumber($blockNumber) {
        $this->blockNumber = $blockNumber;
    }
}
