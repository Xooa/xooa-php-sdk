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
    protected function setUp()
    {
        $this->xooaClient = new XooaClient("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcGlLZXkiOiIxOVMxMFAzLTlRMTRZNTYtS0U0TkpRNS01UlJBQlBIIiwiQXBpU2VjcmV0IjoiWVVVYkVHRU40aHdRWTdxIiwiUGFzc3BocmFzZSI6IjE5MjUwNmQwODk2MjgzNTdjYzhjNWMwN2Y4YzhmNzY3IiwiaWF0IjoxNTQxMDQ0NjgxfQ.MydsbPR2GH4BPiFW4Y3vWfIpFVzB5W86VPqOL7eqUZk");
        $this->xooaClient->validate();
    }
    
    public function testCanCallCurrentIdentity(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $this->xooaClient->getCurrentIdentity()
        );
    }

    public function testCanCallGetIdentities(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $this->xooaClient->getIdentities()
        );
    }

    public function testCanCallEnrollIdentityFromValidArguments(): void
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
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $this->xooaClient->enrollIdentity($identityRequest)
        );
    }

    public function testCanCallEnrollIdentityAsyncFromValidArguments(): void
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
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            $this->xooaClient->enrollIdentityAsync($identityRequest)
        );
    }

    public function testCanCallRegenerateIdentityApiTokenFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $this->xooaClient->regenerateIdentityApiToken("f8cb2816-0820-452e-87eb-53a86546fabc")
        );
    }
    public function testCanCallRegenerateIdentityApiTokenAsyncFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\PendingTransactionResponse',
            $this->xooaClient->regenerateIdentityApiTokenAsync("f8cb2816-0820-452e-87eb-53a86546fabc")
        );
    }
    public function testCanCallGetIdentityFromValidArguments(): void
    {
        $this->assertInstanceOf(
            'XooaSDK\response\IdentityResponse',
            $this->xooaClient->getIdentity("f8cb2816-0820-452e-87eb-53a86546fabc")
        );
    }

    // public function testCanCallDeleteIdentityFromValidArguments(): void
    // {
    //     $this->assertInstanceOf(
    //         DeleteResponse::class,
    //         $this->xooaClient->deleteIdentity("d1fe7d7e-d66b-4fef-8c95-2c67f4879f09")
    //     );
    // }
    // public function testCanCallDeleteIdentityAsyncFromValidArguments(): void
    // {
    //     $this->assertInstanceOf(
    //         'XooaSDK\response\PendingTransactionResponse',
    //         $this->xooaClient->deleteIdentityAsync("8f0b7065-4534-475f-9b9a-972e395f42e9")
    //     );
    // }
}

?>