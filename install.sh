#!/bin/bash

echo "WELCOME"

docker stop $(docker ps -aq)
docker rm $(docker ps -aq)

docker-compose up -d

docker exec app bash init

echo "DONE!"
