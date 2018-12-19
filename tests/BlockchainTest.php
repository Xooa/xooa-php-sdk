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
        $this->xooaClient = new XooaClient("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcGlLZXkiOiI3RDc4MDFQLVRHNjRQRUQtS0FNS1dXNS1DQzlZOVE1IiwiQXBpU2VjcmV0IjoiNThKc0pXMmNXYVNqZWJwIiwiUGFzc3BocmFzZSI6IjA0NDU5YzMxOTczZmZmZTUxMmY4YjE0YmM0YWY4ZTkyIiwiaWF0IjoxNTQzODE0MDg0fQ.53gr7fsngTaWLmcxozpuxCDjDVcScJOCZIdNflZ0fcI");
        $this->xooaClient->validate();
    }
    
    public function testCanGetCurrentBlock(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\CurrentBlockResponse',
            $this->xooaClient->getCurrentBlock()
        );
    }

    public function testCanGetBlockByNumberFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\BlockResponse',
            $this->xooaClient->getBlockByNumber(1)
        );
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

    
    public function testCanGetTransactionByTransactionIdAsyncFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            $this->xooaClient->getTransactionByTransactionIdAsync("9d064180b1ec2a8e16168e4b372d32dc0bb1d1d9ed1c6d9182aa033367412874")
        );
    }
}

?>