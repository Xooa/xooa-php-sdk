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
class IdentityResponse {

    private $identityName;

    private $accessType;

    private $canManageIdentities;

    private $createdAt;

    private $id;

    private $attrs;

    /**
     * getIdentityName
     *
     * @return string
     */
    public function getIdentityName(): string {
        return $this->identityName;
    }

    /**
     * setIdentityName
     *
     * @param  string $identityName
     *
     * @return void
     */
    public function setIdentityName($identityName): void {
        $this->identityName = $identityName;
    }

    /**
     * getAccessType
     *
     * @return string
     */
    public function getAccessType(): string {
        return $this->accessType;
    }

    /**
     * setAccessType
     *
     * @param  string $accessType
     *
     * @return void
     */
    public function setAccessType($accessType): void {
        $this->accessType = $accessType;
    }

    /**
     * isCanManageIdentities
     *
     * @return string
     */
    public function isCanManageIdentities() {
        return $this->canManageIdentities;
    }

    /**
     * setCanManageIdentities
     *
     * @param  string $canManageIdentities
     *
     * @return void
     */
    public function setCanManageIdentities($canManageIdentities): void {
        $this->canManageIdentities = $canManageIdentities;
    }

    /**
     * getCreatedAt
     *
     * @return string
     */
    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    /**
     * setCreatedAt
     *
     * @param  string $createdAt
     *
     * @return void
     */
    public function setCreatedAt($createdAt): void {
        $this->createdAt = $createdAt;
    }

    /**
     * getId
     *
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }

    /**
     * setId
     *
     * @param  string $id
     *
     * @return void
     */
    public function setId($id): void {
        $this->id = $id;
    }

    /**
     * getAttrs
     *
     * @return string
     */
    public function getAttrs(): string {
        return $this->attrs;
    }

    /**
     * setAttrs
     *
     * @param  string $attrs
     *
     * @return void
     */
    public function setAttrs($attrs): void {
        $this->attrs = $attrs;
    }
}