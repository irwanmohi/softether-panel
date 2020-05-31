#!/bin/bash

SOURCE_NETWORK=$1
TARGET_IMAGE=$2

echo "Building and attaching network"

#creating
docker network create $SOURCE_NETWORK

# attaching
docker network connect $SOURCE_NETWORK $TARGET_IMAGE
