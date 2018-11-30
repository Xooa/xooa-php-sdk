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
        $this->xooaClient = new XooaClient("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcGlLZXkiOiIxOVMxMFAzLTlRMTRZNTYtS0U0TkpRNS01UlJBQlBIIiwiQXBpU2VjcmV0IjoiWVVVYkVHRU40aHdRWTdxIiwiUGFzc3BocmFzZSI6IjE5MjUwNmQwODk2MjgzNTdjYzhjNWMwN2Y4YzhmNzY3IiwiaWF0IjoxNTQxMDQ0NjgxfQ.MydsbPR2GH4BPiFW4Y3vWfIpFVzB5W86VPqOL7eqUZk");
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
}

?>