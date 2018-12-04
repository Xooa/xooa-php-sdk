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
    private $invokeResultID = "f2dd1f2a-9733-4f55-8be4-b767035da95f";
    private $queryResultID = "880671f6-b5ba-467e-8e12-ee935ebe9826";
    private $identityResultID = "e2e98400-bce2-4afa-9794-419d1a02192d";
    private $deleteIdentityResultID = "20e173ad-53dc-4860-9455-829582a54dac";
    private $currentBlockResultID = "a5ba06d5-3d7a-474e-90be-68f900ce555e";
    private $blockResultID = "25c99609-572d-49ed-b904-9d0ae9cc95f9";
    private $transactionResultID = "83c94909-60b5-453d-8f82-75846cecfeb5";
    protected function setUp()
    {
        $this->xooaClient = new XooaClient("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcGlLZXkiOiI3RDc4MDFQLVRHNjRQRUQtS0FNS1dXNS1DQzlZOVE1IiwiQXBpU2VjcmV0IjoiNThKc0pXMmNXYVNqZWJwIiwiUGFzc3BocmFzZSI6IjA0NDU5YzMxOTczZmZmZTUxMmY4YjE0YmM0YWY4ZTkyIiwiaWF0IjoxNTQzODE0MDg0fQ.53gr7fsngTaWLmcxozpuxCDjDVcScJOCZIdNflZ0fcI");
        $this->xooaClient->validate();
    }
    
    public function testCanGetResultForQueryFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\QueryResponse',
            $this->xooaClient->getResultForQuery($queryResultID)
        );
    }
    public function testCanGetResultForInvokeFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\InvokeResponse',
            $this->xooaClient->getResultForInvoke($invokeResultID)
        );
    }
    public function testCanGetResultForIdentityFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $this->xooaClient->getResultForIdentity($identityResultID)
        );
    }
    public function testCanGetResultForDeleteIdentityFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $this->xooaClient->getResultForDeleteIdentity($deleteIdentityResultID)
        );
    }
    public function testCanGetResultForCurrentBlockFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\CurrentBlockResponse',
            $this->xooaClient->getResultForCurrentBlock($currentBlockResultID)
        );
    }
    public function testCanGetResultForBlockByNumberFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\BlockResponse',
            $this->xooaClient->getResultForBlockByNumber($blockResultID)
        );
    }
    public function testCanGetResultForTransactionFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\TransactionResponse',
            $this->xooaClient->getResultForTransaction($transactionResultID)
        );
    }
}

?>