#!/bin/bash

function Banner()
{
    echo -e "\e[91m #########################################################################\e[0m"
    echo -e "   \e[95m_______\e[0m  \e[95m_______\e[0m  __   __  _______  _______  __    _  _______  ___       "
    echo -e "  |       ||       ||  | |  ||       ||   \e[91m_\e[0m   ||  |  | ||       ||   |      "
    echo -e "  |  _____||  _____||  |_|  ||    \e[91m_\e[0m  ||  \e[91m|_|\e[0m  ||  |_|  ||    ___||   |      "
    echo -e "  | |_____ | |_____ |       ||   \e[91m|_|\e[0m ||       ||       ||   |___ |   |      "
    echo -e "  |_____  ||_____  ||       ||    ___||       ||  _    ||    ___||   |___   "
    echo -e "   _____| | _____| ||   _   ||   |    |   _   || | |   ||   |___ |       |  "
    echo -e "  |\e[95m_______\e[0m||\e[95m_______\e[0m||__| |__||___|    |__| |__||_|  |__||_______||_______|  "
    echo ""
    echo -e "\e[91m #########################################################################\e[0m"

    echo "SSHPANEL™ SOFTETHER PANEL INSTALLATION"
    echo "~ Version: 1.0"
}

Banner

echo ""
echo "--------------------------------"
echo "PLEASE ONLY RUN THIS SCRIPT ONCE! YOUR DATA WILL BE LOST IF YOU RUN THIS SCRIPT MULTIPLE TIMES."
echo "HIT CTRL-C NOW IF YOU WANT TO ABORT THE INSTALLATION!"

sleep 10

cp ENVIRONMENT .env

docker stop $(docker ps -aq)
docker rm $(docker ps -aq)
docker image rm $(docker image ls -aq)

bash vessel init

# Ensure containers are not running
./vessel down

# Delete the Docker images built previously
docker image rm vessel/app
docker image rm vessel/node
docker volume rm $(docker volume ls -q)

./vessel start

echo "RELOADING CONFIGURATION"
sleep 10

# BUILD COMPLETED, RUN THE SETUP
./vessel artisan key:generate
./vessel artisan migrate --seed

# Clearing STDOUT
clear

./vessel artisan panel:setup

echo "INSTALLATION COMPLETED!"
