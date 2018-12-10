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

package main

import (
	"fmt"
	"strconv"

	"github.com/hyperledger/fabric/core/chaincode/shim"
	"github.com/hyperledger/fabric/protos/peer"
)

var logger = shim.NewLogger("get-setSC")

// SimpleAsset implements a simple chaincode to manage an asset
type SimpleAsset struct {
}

// Init is called during chaincode instantiation to initialize any
// data. Note that chaincode upgrade also calls this function to reset
// or to migrate data.
func (t *SimpleAsset) Init(stub shim.ChaincodeStubInterface) peer.Response {
	logger.Debug("Init() called.")
	return shim.Success(nil)
}

// Invoke is called per transaction on the chaincode. Each transaction is
// either a 'get' or a 'set' on the asset created by Init function. The Set
// method may create a new asset by specifying a new key-value pair.
func (t *SimpleAsset) Invoke(stub shim.ChaincodeStubInterface) peer.Response {
	logger.Debug("Invoke() called.")
	// Extract the function and args from the transaction proposal
	fn, args := stub.GetFunctionAndParameters()

	if fn == "set" {
		return t.set(stub, args)
	} else if fn == "get" {
		return t.get(stub, args)
	} else if fn == "getVersion" {
		return t.getVersion(stub)
	}

	logger.Error("Function declaration not found for ", fn)
	resp := shim.Error("Invalid function name : " + fn)
	resp.Status = 404
	return resp
}

// getVersion retrieves the name and version of this smart contract
func (t *SimpleAsset) getVersion(stub shim.ChaincodeStubInterface) peer.Response {
	logger.Debug("getVersion called.")

	return shim.Success([]byte("get-set:1.0.0"))
}

// Set stores the asset (both key and value) on the ledger. If the key exists,
// it will override the value with the new one
func (t *SimpleAsset) set(stub shim.ChaincodeStubInterface, args []string) peer.Response {
	logger.Debug("set() called.")
	if len(args) != 2 {
		logger.Error("Incorrect number of arguments passed in set.")
		resp := shim.Error("Incorrect number of arguments. Expecting 2 arguments: " + strconv.Itoa(len(args)) + " given.")
		resp.Status = 400
		return resp
	}

	err := stub.PutState(args[0], []byte(args[1]))
	if err != nil {
		logger.Error("Error occured while calling PutState(): ", err)
		return shim.Error("Failed to set asset: " + args[0])
	}
	//Setting event for the value stored
	err = stub.SetEvent("Set", []byte(args[1]))

	return shim.Success([]byte(args[0] + ":" + args[1]))
}

// Get returns the value of the specified asset key
func (t *SimpleAsset) get(stub shim.ChaincodeStubInterface, args []string) peer.Response {
	logger.Debug("get() called.")
	if len(args) != 1 {
		resp := shim.Error("Incorrect number of arguments. Expecting 1 arguments: " + strconv.Itoa(len(args)) + " given.")
		resp.Status = 400
		return resp
	}

	value, err := stub.GetState(args[0])
	if err != nil {
		logger.Error("Error occured while calling GetState(): ", err)
		return shim.Error("Failed to get asset: " + args[0])
	}
	if value == nil {
		logger.Info("No data received for key : ", args[0])
		resp := shim.Error("Asset not found: " + args[0])
		resp.Status = 400
		return resp
	}
	return shim.Success(value)
}

// main function starts up the chaincode in the container during instantiate
func main() {
	if err := shim.Start(new(SimpleAsset)); err != nil {
		logger.Error("Error starting SimpleAsset chaincode: ", err)
		fmt.Printf("Error starting SimpleAsset chaincode: %s", err)
	}
}
