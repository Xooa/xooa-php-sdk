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

use PHPUnit\Framework\TestCase;
use XooaSDK\XooaClient;

final class BlockchainTest extends TestCase {
    protected function setUp()
    {
        $this->xooaClient = new XooaClient("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcGlLZXkiOiI3RDc4MDFQLVRHNjRQRUQtS0FNS1dXNS1DQzlZOVE1IiwiQXBpU2VjcmV0IjoiQUNDRXR4aGRvT0swcmZ5IiwiUGFzc3BocmFzZSI6IjQ4MTBmZDNiNTUzNWFkNmUwMTYzNjQyM2UyNGEyZDE1IiwiaWF0IjoxNTQ1Mjc5NTE5fQ.pv-ySA8Vv03RQwVwjynJ3RqODenzksiprAzy9g_mgcM");
        $this->xooaClient->validate();

        $this->xooaClient1 = new XooaClient("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcGlLZXkiOiI3RDc4MDFQLVRHNjRQRUQtS0FNS1dXNS1DQzlZOVE1IiwiQXBpU2VjcmV0IjoiQUNDRXR4aGRvT0swcmZ5IiwiUGFzc3BocmFzZSI6IjQ4MTBmZDNiNTUzNWFkNmUwMTYzNjQyM2UyNGEyZDE1IiwiaWF0IjoxNTQ1Mjc5NTE5fQ.pv-ySA8Vv03RQwVwjynJ3RqODenzksiprAzy9g_mgcM");
        $this->xooaClient1->validate();
        $this->xooaClient1->setUrl("https://api.ci.xooa.io/api/v1");
    }
    
    public function testCanGetCurrentBlock(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\CurrentBlockResponse',
            $this->xooaClient->getCurrentBlock()
        );
    }

    /**
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetCurrentBlockFromInvalidApiKey(): void
    {
        $this->xooaClient1->getCurrentBlock();
    }

    public function testCanGetBlockByNumberFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\BlockResponse',
            $this->xooaClient->getBlockByNumber(1)
        );
    }

    /**
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetBlockByNumberFromInvalidApiKey(): void
    {
        $this->xooaClient1->getBlockByNumber(1);
    }

    public function testCanGetCurrentBlockAsync(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            $this->xooaClient->getCurrentBlockAsync()
        );
    }

    public function testCanGetBlockByNumberAsyncFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            $this->xooaClient->getBlockByNumberAsync(1)
        );
    }

    /**
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetBlockByNumberAsyncFromInvalidApiKey(): void
    {
        $this->xooaClient1->getBlockByNumberAsync(1);
    }

    public function testCanGetTransactionByTransactionIdFromValidArguments()
    {
        $response = $this->xooaClient->invoke('set',["args1","args2"]);
        $trxnId = $response->getTransactionId();
        $this->assertInstanceOf(
            'XooaSDK\response\TransactionResponse',
            $this->xooaClient->getTransactionByTransactionId($trxnId)
        );
        return $trxnId;
    }

    /**
     * @depends testCanGetTransactionByTransactionIdFromValidArguments
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetTransactionByTransactionIdFromInvalidApiKey($trxnId): void
    {
        $this->xooaClient1->getTransactionByTransactionId($trxnId);
    }

    /**
     * @depends testCanGetTransactionByTransactionIdFromValidArguments
     */
    public function testCanGetTransactionByTransactionIdAsyncFromValidArguments($trxnId): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            $this->xooaClient->getTransactionByTransactionIdAsync($trxnId)
        );
    }
}

?>