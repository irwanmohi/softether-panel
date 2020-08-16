#!/bin/bash

CONTAINER_APP="app"

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

    echo "SSHPANEL™ SOFTETHER PANEL UPDATER"
    echo "~ Version: 1.0"
}


Banner

echo ""
echo "--------------------------------"
echo "PLEASE ONLY RUN THIS SCRIPT ONCE! YOUR DATA WILL BE LOST IF YOU RUN THIS SCRIPT MULTIPLE TIMES."
echo "HIT CTRL-C NOW IF YOU WANT TO ABORT THE INSTALLATION!"

sleep 10

if [ ! -f .env ]; then
    cp ENVIRONMENT .env
fi

docker-compose up -d --force-recreate --build $CONTAINER_APP

echo "RELOADING CONFIGURATION"
sleep 10

# BUILD COMPLETED, RUN THE SETUP
./vessel artisan migrate --seed


echo "UPDATE COMPLETED!"
