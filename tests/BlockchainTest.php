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
    private static $xooaClient;
    private static $xooaClient1;
    public static function setUpBeforeClass()
    {
        self::$xooaClient = new XooaClient("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcGlLZXkiOiI3RDc4MDFQLVRHNjRQRUQtS0FNS1dXNS1DQzlZOVE1IiwiQXBpU2VjcmV0IjoiQUNDRXR4aGRvT0swcmZ5IiwiUGFzc3BocmFzZSI6IjQ4MTBmZDNiNTUzNWFkNmUwMTYzNjQyM2UyNGEyZDE1IiwiaWF0IjoxNTQ1Mjc5NTE5fQ.pv-ySA8Vv03RQwVwjynJ3RqODenzksiprAzy9g_mgcM");
        self::$xooaClient->validate();

        self::$xooaClient1 = new XooaClient("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcGlLZXkiOiI3RDc4MDFQLVRHNjRQRUQtS0FNS1dXNS1DQzlZOVE1IiwiQXBpU2VjcmV0IjoiQUNDRXR4aGRvT0swcmZ5IiwiUGFzc3BocmFzZSI6IjQ4MTBmZDNiNTUzNWFkNmUwMTYzNjQyM2UyNGEyZDE1IiwiaWF0IjoxNTQ1Mjc5NTE5fQ.pv-ySA8Vv03RQwVwjynJ3RqODenzksiprAzy9g_mgcM");
        self::$xooaClient1->validate();
        self::$xooaClient1->setUrl("https://api.ci.xooa.io/api/v1");
    }
    
    public function testCanGetCurrentBlock(): void
    {
        sleep(5);
        $this->assertInstanceOf(
            'XooaSDK\response\CurrentBlockResponse',
            self::$xooaClient->getCurrentBlock()
        );
    }

    /**
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetCurrentBlockFromInvalidApiKey(): void
    {
        self::$xooaClient1->getCurrentBlock();
    }

    public function testCanGetBlockByNumberFromValidArguments(): void
    {
        $response = self::$xooaClient->getBlockByNumber(1);
        $this->assertInstanceOf(
            'XooaSDK\response\BlockResponse',
            $response
        );
        $this->assertEquals(1, $response->getBlockNumber());
        $this->assertEquals(1, $response->getNumberOfTransactions());
    }

    /**
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetBlockByNumberFromInvalidApiKey(): void
    {
        self::$xooaClient1->getBlockByNumber(1);
    }

    public function testCanGetCurrentBlockAsync(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            self::$xooaClient->getCurrentBlockAsync()
        );
    }

    public function testCanGetBlockByNumberAsyncFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            self::$xooaClient->getBlockByNumberAsync(1)
        );
    }

    /**
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetBlockByNumberAsyncFromInvalidApiKey(): void
    {
        self::$xooaClient1->getBlockByNumberAsync(1);
    }

    public function testCanGetTransactionByTransactionIdFromValidArguments()
    {
        $response = self::$xooaClient->invoke('set',["args1","args2"]);
        $trxnId = $response->getTransactionId();
        $response1 = self::$xooaClient->getTransactionByTransactionId($trxnId);
        $this->assertInstanceOf(
            'XooaSDK\response\TransactionResponse',
            $response1
        );
        $this->assertEquals($trxnId, $response1->getTxid());
        return $trxnId;
    }

    /**
     * @depends testCanGetTransactionByTransactionIdFromValidArguments
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetTransactionByTransactionIdFromInvalidApiKey($trxnId): void
    {
        self::$xooaClient1->getTransactionByTransactionId($trxnId);
    }

    /**
     * @depends testCanGetTransactionByTransactionIdFromValidArguments
     */
    public function testCanGetTransactionByTransactionIdAsyncFromValidArguments($trxnId): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            self::$xooaClient->getTransactionByTransactionIdAsync($trxnId)
        );
    }
}

?>