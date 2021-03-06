#!/bin/bash


# Set environment variables for dev

SEDCMD="sed -i"
export APP_PORT=${APP_PORT:-80}
export MYSQL_PORT=${MYSQL_PORT:-3306}
export WWWUSER=${WWWUSER:-$UID}

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

# Setting up environment.

IPADDRESS=$(curl ipv4.icanhazip.com)
$SEDCMD "s|APP_URL=.*|APP_URL=http://$IPADDRESS|" ENVIRONMENT

cp ENVIRONMENT .env

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

KEY=$(bash vessel artisan key:generate --show | sed 's/\x1B[@A-Z\\\]^_]\|\x1B\[[0-9:;<=>?]*[-!"#$%&'"'"'()*+,.\/]*[][\\@A-Z^_`a-z{|}~]//g')

$SEDCMD "s|APP_KEY=.*|APP_KEY=$KEY|" ENVIRONMENT
$SEDCMD "s|APP_KEY=.*|APP_KEY=$KEY|" .env

./vessel artisan migrate --seed

# Clearing STDOUT
clear

./vessel artisan panel:setup

echo "INSTALLATION COMPLETED!"
