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

class BlockResponse {
    private $previousHash;
    private $dataHash;
    private $numberOfTransactions;
    private $blockNumber;

    /**
     * getPreviousHash
     *
     * @return string
     */
    public function getPreviousHash(): string {
        return $this->previousHash;
    }

    /**
     * setPreviousHash
     *
     * @param  mixed $previousHash
     *
     * @return string
     */
    public function setPreviousHash($previousHash): void {
        $this->previousHash = $previousHash;
    }

    /**
     * getDataHash
     *
     * @return string
     */
    public function getDataHash(): string {
        return $this->dataHash;
    }

    /**
     * setDataHash
     *
     * @param  string $dataHash
     *
     * @return void
     */
    public function setDataHash($dataHash): void {
        $this->dataHash = $dataHash;
    }

    /**
     * getNumberOfTransactions
     *
     * @return int
     */
    public function getNumberOfTransactions(): int {
        return $this->numberOfTransactions;
    }

    /**
     * setNumberOfTransactions
     *
     * @param  int $numberOfTransactions
     *
     * @return void
     */
    public function setNumberOfTransactions($numberOfTransactions) {
        $this->numberOfTransactions = $numberOfTransactions;
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
    public function setBlockNumber($blockNumber): void {
        $this->blockNumber = $blockNumber;
    }
}
