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

    namespace XooaSDK;
    use ElephantIO\Client;
    use ElephantIO\Engine\SocketIO\Version2X;
    use ElephantIO\Exception\ServerConnectionFailureException;
    use XooaSDK\exception\XooaApiException;

    class EventsApi {
        private static $subscribed = 1;
        
        /**
         * subscribe to chaincode events
         *
         * @param  string $socketUrl
         * @param  string $apiToken
         * @param  callable $callbackFn
         *
         * @return void
         */
        public function subscribe($socketUrl, $apiToken, callable $callbackFn) {
            $this::$subscribed = 1;
            try {
                $client = new Client(new Version2X($socketUrl.'/subscribe'));
                $client->initialize();
                $client->emit('authenticate', ['token' => $apiToken]);
                $r = $client->read();
                if($r != '42["authenticated"]') {
                    XooaClient::$log->error('Exception occured: Invalid API Token');
                    $apiException = new XooaApiException();
                    $apiException->setErrorCode(401);
                    $apiException->setErrorMessage("Invalid API Token");
                    throw $apiException;
                }
            } catch(ServerConnectionFailureException $e) {
                XooaClient::$log->error('Exception occured: Invalid URL');
                $apiException = new XooaApiException();
                $apiException->setErrorCode(400);
                $apiException->setErrorMessage($e->getMessage());
                throw $apiException;
            }

            while ($this::$subscribed == 1) {
                $r = $client->read();
                if(!empty($r)) {
                    XooaClient::$log->debug('Event occured: '.$r);
                    $r = substr($r,2);
                    $r = json_decode($r,true);
                    if(isset($r[1]) && isset($r[1]["eventName"])) {
                        call_user_func($callbackFn,$r);
                    }
                }
            }
        }

        /**
         * unsubscribe events
         *
         * @return void
         */
        public function unsubscribe() {
            $this::$subscribed = 0;
        }
    }
?>