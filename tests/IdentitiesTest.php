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

final class IdentitiesTest extends TestCase {

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
    
    public function testCanCallCurrentIdentity(): void
    {
        sleep(5);
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            self::$xooaClient->currentIdentity()
        );
    }

    /**
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotCallCurrentIdentityFromInvalidApiKey(): void
    {
        self::$xooaClient1->currentIdentity();
    }

    public function testCanCallGetIdentities(): void
    {
        $identities = self::$xooaClient->getIdentities();
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $identities[0]
        );
    }

    /**
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotCallGetIdentitiesFromInvalidApiKey(): void
    {
        $identities = self::$xooaClient1->getIdentities();
    }

    public function testCanCallEnrollIdentityFromValidArguments()
    {
        $identityRequest = '{
            "IdentityName": "string",
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
        $response = self::$xooaClient->enrollIdentity($identityRequest);
        $identityId1 = $response->getId();
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $response
        );
        return $identityId1;
    }

    public function testCanCallEnrollIdentityAsyncFromValidArguments()
    {
        $identityRequest = '{
            "IdentityName": "string",
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
        $response = self::$xooaClient->enrollIdentityAsync($identityRequest);
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            $response
        );
        sleep(5);
        $identityResultID = $response->getResultId();
        $response = self::$xooaClient->getResultForIdentity($identityResultID);
        $identityId2 = $response->getId();
        return $identityId2;
    }

    /**
     * @depends testCanCallEnrollIdentityFromValidArguments
     */
    public function testCanCallRegenerateIdentityApiTokenFromValidArguments($identityId1): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            self::$xooaClient->regenerateIdentityApiToken($identityId1)
        );
    }

    /**
     * @depends testCanCallEnrollIdentityFromValidArguments
     */
    public function testCanCallRegenerateIdentityApiTokenAsyncFromValidArguments($identityId1): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            self::$xooaClient->regenerateIdentityApiTokenAsync($identityId1)
        );
    }

    /**
     * @depends testCanCallEnrollIdentityFromValidArguments
     * @expectedException XooaSDK\exception\XooaApiException
     */
    public function testCannotCallRegenerateIdentityApiTokenAsyncFromInvalidApiKey($identityId1): void
    {
        self::$xooaClient1->regenerateIdentityApiTokenAsync($identityId1);
    }

    /**
     * @depends testCanCallEnrollIdentityFromValidArguments
     */
    public function testCanCallGetIdentityFromValidArguments($identityId1): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            self::$xooaClient->getIdentity($identityId1)
        );
    }

    /**
     * @depends testCanCallEnrollIdentityFromValidArguments
     */
    public function testCanCallDeleteIdentityFromValidArguments($identityId1): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\DeleteResponse',
            self::$xooaClient->deleteIdentity($identityId1)
        );
    }

    /**
     * @expectedException XooaSDK\exception\XooaApiException
     * @depends testCanCallEnrollIdentityFromValidArguments
     */
    public function testCannotCallDeleteIdentityFromInvaliApiToken($identityId1): void
    {
        self::$xooaClient1->deleteIdentity($identityId1);
    }

    /**
     * @depends testCanCallEnrollIdentityAsyncFromValidArguments
     */
    public function testCanCallDeleteIdentityAsyncFromValidArguments($identityId2): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            self::$xooaClient->deleteIdentityAsync($identityId2)
        );
    }
}

?>