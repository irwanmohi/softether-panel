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

mv environment .env

./vessel init
./vessel start
./vessel artisan key:generate
./vessel artisan migrate --seed
./vessel artisan panel:setup

echo "INSTALLATION COMPLETED!"
