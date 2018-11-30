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

final class resultsTest extends TestCase {
    protected function setUp()
    {
        $this->xooaClient = new XooaClient("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcGlLZXkiOiIxOVMxMFAzLTlRMTRZNTYtS0U0TkpRNS01UlJBQlBIIiwiQXBpU2VjcmV0IjoiWVVVYkVHRU40aHdRWTdxIiwiUGFzc3BocmFzZSI6IjE5MjUwNmQwODk2MjgzNTdjYzhjNWMwN2Y4YzhmNzY3IiwiaWF0IjoxNTQxMDQ0NjgxfQ.MydsbPR2GH4BPiFW4Y3vWfIpFVzB5W86VPqOL7eqUZk");
        $this->xooaClient->validate();
    }
    
    public function testCanGetResultForQueryFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\QueryResponse',
            $this->xooaClient->getResultForQuery("84c77812-0f9a-49b5-9de4-03816c5476e5")
        );
    }
    public function testCanGetResultForInvokeFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\InvokeResponse',
            $this->xooaClient->getResultForInvoke("c0e1a76a-9a2c-42ec-b6f6-74c3ed3b285f")
        );
    }
    public function testCanGetResultForIdentityFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $this->xooaClient->getResultForIdentity("130343f9-4212-4971-85a6-e5a451ba3399")
        );
    }
    public function testCanGetResultForDeleteIdentityFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $this->xooaClient->getResultForDeleteIdentity("130343f9-4212-4971-85a6-e5a451ba3399")
        );
    }
    public function testCanGetResultForCurrentBlockFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\CurrentBlockResponse',
            $this->xooaClient->getResultForCurrentBlock("1ade7805-7137-488f-9cfc-f421f1af971c")
        );
    }
    public function testCanGetResultForBlockByNumberFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\BlockResponse',
            $this->xooaClient->getResultForBlockByNumber("ae5548c5-b13f-4666-9fbc-e86bdd3ff1a1")
        );
    }
}

?>