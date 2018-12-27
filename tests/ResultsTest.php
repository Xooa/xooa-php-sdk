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
        $this->xooaClient = new XooaClient("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcGlLZXkiOiI3RDc4MDFQLVRHNjRQRUQtS0FNS1dXNS1DQzlZOVE1IiwiQXBpU2VjcmV0IjoiQUNDRXR4aGRvT0swcmZ5IiwiUGFzc3BocmFzZSI6IjQ4MTBmZDNiNTUzNWFkNmUwMTYzNjQyM2UyNGEyZDE1IiwiaWF0IjoxNTQ1Mjc5NTE5fQ.pv-ySA8Vv03RQwVwjynJ3RqODenzksiprAzy9g_mgcM");
        $this->xooaClient->validate();

        $this->xooaClient1 = new XooaClient("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcGlLZXkiOiI3RDc4MDFQLVRHNjRQRUQtS0FNS1dXNS1DQzlZOVE1IiwiQXBpU2VjcmV0IjoiQUNDRXR4aGRvT0swcmZ5IiwiUGFzc3BocmFzZSI6IjQ4MTBmZDNiNTUzNWFkNmUwMTYzNjQyM2UyNGEyZDE1IiwiaWF0IjoxNTQ1Mjc5NTE5fQ.pv-ySA8Vv03RQwVwjynJ3RqODenzksiprAzy9g_mgcM");
        $this->xooaClient1->validate();
        $this->xooaClient1->setUrl("https://api.ci.xooa.io/api/v1");
    }
    
    public function testCanGetResultForQueryFromValidArguments()
    {
        $response = $this->xooaClient->queryAsync('get',["args1"]);
        $queryResultID = $response->getResultId();
        sleep(5);
        $this->assertInstanceOf(
            'XooaSDK\response\QueryResponse',
            $this->xooaClient->getResultForQuery($queryResultID)
        );
        return $queryResultID;
    }

    /**
     * @depends testCanGetResultForQueryFromValidArguments
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetResultForQueryFromInvalidApiKey($queryResultID): void
    {
        $this->xooaClient1->getResultForQuery($queryResultID);
    }

    public function testCanGetResultForInvokeFromValidArguments()
    {
        $response = $this->xooaClient->invokeAsync('set',["args1","args2"]);
        $invokeResultID = $response->getResultId();
        sleep(5);
        $this->assertInstanceOf(
            'XooaSDK\response\InvokeResponse',
            $this->xooaClient->getResultForInvoke($invokeResultID)
        );
        return $invokeResultID;
    }

    /**
     * @depends testCanGetResultForInvokeFromValidArguments
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetResultForInvokeFromInvalidApiKey($invokeResultID): void
    {
        $this->xooaClient1->getResultForInvoke($invokeResultID);
    }

    public function testCanGetResultForIdentityFromValidArguments()
    {
        $identityRequest = '{
            "IdentityName": "string2",
            "Access": "r",
            "Attrs": [
                {
                "name": "string",
                "ecert": true,
                "value": "string"
                }
            ],
            "canManageIdentities": true
            }';
        $response = $this->xooaClient->enrollIdentityAsync($identityRequest);
        $identityResultID = $response->getResultId();
        sleep(5);
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $this->xooaClient->getResultForIdentity($identityResultID)
        );
        return $identityResultID;
    }

    /**
     * @depends testCanGetResultForIdentityFromValidArguments
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetResultForIdentityFromInvalidApiKey($identityResultID): void
    {
        $this->xooaClient1->getResultForIdentity($identityResultID);
    }

    /**
     * @depends testCanGetResultForIdentityFromValidArguments
     */
    public function testCanGetResultForDeleteIdentityFromValidArguments($identityResultID)
    {
        $response = $this->xooaClient->getResultForIdentity($identityResultID);
        $identityId = $response->getId();
        $response = $this->xooaClient->deleteIdentityAsync($identityId);
        $deleteIdentityResultID = $response->getResultId();
        sleep(5);
        $this->assertInstanceOf(
            'XooaSDK\response\DeleteResponse',
            $this->xooaClient->getResultForDeleteIdentity($deleteIdentityResultID)
        );
        return $deleteIdentityResultID;
    }

    /**
     * @depends testCanGetResultForDeleteIdentityFromValidArguments
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetResultForDeleteIdentityFromInvalidApiKey($deleteIdentityResultID): void
    {
        $this->xooaClient1->getResultForDeleteIdentity($deleteIdentityResultID);
    }

    public function testCanGetResultForCurrentBlockFromValidArguments()
    {
        $response = $this->xooaClient->getCurrentBlockAsync();
        $currentBlockResultID = $response->getResultId();
        sleep(5);
        $this->assertInstanceOf(
            'XooaSDK\response\CurrentBlockResponse',
            $this->xooaClient->getResultForCurrentBlock($currentBlockResultID)
        );
        return $currentBlockResultID;
    }

    /**
     * @depends testCanGetResultForCurrentBlockFromValidArguments
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetResultForCurrentBlockFromInvalidApiKey($currentBlockResultID): void
    {
        $this->xooaClient1->getResultForCurrentBlock($currentBlockResultID);
    }

    public function testCanGetResultForBlockByNumberFromValidArguments()
    {
        $response = $this->xooaClient->getBlockByNumberAsync(1);
        $blockResultID = $response->getResultId();
        sleep(5);
        $this->assertInstanceOf(
            'XooaSDK\response\BlockResponse',
            $this->xooaClient->getResultForBlockByNumber($blockResultID)
        );
        return $blockResultID;
    }

    /**
     * @depends testCanGetResultForBlockByNumberFromValidArguments
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetResultForBlockByNumberFromInvalidApiKey($blockResultID): void
    {
        $this->xooaClient1->getResultForBlockByNumber($blockResultID);
    }

    /**
     * @depends testCanGetResultForInvokeFromValidArguments
     */
    public function testCanGetResultForTransactionFromValidArguments($invokeResultID)
    {
        $response = $this->xooaClient->getResultForInvoke($invokeResultID);
        $trxnId = $response->getTransactionId();
        $response = $this->xooaClient->getTransactionByTransactionIdAsync($trxnId);
        $transactionResultID = $response->getResultId();
        sleep(5);
        $this->assertInstanceOf(
            'XooaSDK\response\TransactionResponse',
            $this->xooaClient->getResultForTransaction($transactionResultID)
        );
        return $transactionResultID;
    }

    /**
     * @depends testCanGetResultForTransactionFromValidArguments
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotGetResultForTransactionFromInvalidApiKey($transactionResultID): void
    {
        $this->xooaClient1->getResultForTransaction($transactionResultID);
    }
}

?>