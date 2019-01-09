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

class TransactionResponse {
    private $txid;
    private $createdt;
    private $smartcontract;
    private $creator_msp_id;
    private $endorser_msp_id;
    private $type;
    private $read_set;
    private $write_set;

    /**
     * getTxid
     *
     * @return string
     */
    public function getTxid(): string {
        return $this->txid;
    }

    /**
     * setTxid
     *
     * @param string $txid
     *
     * @return string
     */
    public function setTxid($txid): void {
        $this->txid = $txid;
    }

    /**
     * getCreatedt
     *
     * @return string
     */
    public function getCreatedt(): string {
        return $this->createdt;
    }

    /**
     * setCreatedt
     *
     * @param string $createdt
     *
     * @return void
     */
    public function setCreatedt($createdt): void {
        $this->createdt = $createdt;
    }

    /**
     * getSmartcontract
     *
     * @return string
     */
    public function getSmartcontract(): string {
        return $this->smartcontract;
    }

    /**
     * setSmartcontract
     *
     * @param string $smartcontract
     *
     * @return void
     */
    public function setSmartcontract($smartcontract) {
        $this->smartcontract = $smartcontract;
    }

    /**
     * getCreatorMspId
     *
     * @return string
     */
    public function getCreatorMspId(): string {
        return $this->creator_msp_id;
    }
    
    /**
     * setCreatorMspId
     *
     * @param string $creator_msp_id
     *
     * @return void
     */
    public function setCreatorMspId($creator_msp_id): void {
        $this->creator_msp_id = $creator_msp_id;
    }

    /**
     * getEndorserMspId
     *
     * @return string
     */
    public function getEndorserMspId(): string {
        return $this->endorser_msp_id;
    }
    
    /**
     * setEndorserMspId
     *
     * @param string $endorser_msp_id
     *
     * @return void
     */
    public function setEndorserMspId($endorser_msp_id): void {
        $this->endorser_msp_id = $endorser_msp_id;
    }

    /**
     * getType
     *
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }
    
    /**
     * setType
     *
     * @param string $type
     *
     * @return void
     */
    public function setType($type): void {
        $this->type = $type;
    }

    /**
     * getReadSet
     *
     * @return string
     */
    public function getReadSet(): string {
        return $this->read_set;
    }
    
    /**
     * setReadSet
     *
     * @param string $read_set
     *
     * @return void
     */
    public function setReadSet($read_set): void {
        $this->read_set = $read_set;
    }

    /**
     * getWriteSet
     *
     * @return string
     */
    public function getWriteSet(): string {
        return $this->creator_msp_id;
    }
    
    /**
     * setWriteSet
     *
     * @param string $write_set
     *
     * @return void
     */
    public function setWriteSet($write_set): void {
        $this->write_set = $write_set;
    }
}
