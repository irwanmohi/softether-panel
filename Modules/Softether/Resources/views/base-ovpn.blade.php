####################################################################################
#   _______  _______  __   __  _______  _______  __    _  _______  ___             #
#  |       ||       ||  | |  ||       ||   _   ||  |  | ||       ||   |            #
#  |  _____||  _____||  |_|  ||    _  ||  |_|  ||   |_| ||    ___||   |            #
#  | |_____ | |_____ |       ||   |_| ||       ||       ||   |___ |   |            #
#  |_____  ||_____  ||       ||    ___||       ||  _    ||    ___||   |___         #
#   _____| | _____| ||   _   ||   |    |   _   || | |   ||   |___ |       |        #
#  |_______||_______||__| |__||___|    |__| |__||_|  |__||_______||_______|        #
#                                                                                  #
#     GENERATED BY SOFTETHER VPN PANEL BY SSHPANEL.IO                              #
#     Website: https://sshpanel.io                                                 #
#     Contact: contact@sshpanel.io                                                 #
#                                                                                  #
# ##################################################################################

dev tun
proto udp

remote {{ $REMOTE_SERVER }} 1194

cipher AES-128-CBC
auth SHA1
resolv-retry infinite
nobind
persist-key
persist-tun
client
verb 3

{{ $ADDITIONAL_CONFIGURATIONS ?? '# NO ADDITIONAL CONFIGURATION HAS BEEN SET.' }}


# AUTHENTICATION METHOD
{{ $AUTH_METHOD }}

# DO NOT MODIFY CONFIGURATION BELOW

<ca>
{{ $SERVER_CA }}
</ca>

<cert>
{{ $USER_CERT }}
</cert>

<key>
{{ $USER_KEY }}
</key>

# DO NOT MODIFY CONFIGURATION ABOVE
