<?php

namespace App\Console\Commands;

use App\User;
use App\Server;
use App\Setting;
use App\ServerScript;
use phpseclib\Crypt\RSA;
use App\Facades\ServerUtils;
use Illuminate\Console\Command;
use App\Contracts\Server\ServerHook;

class SetupPanel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'panel:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the panel for the first time.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('
####################################################################################
#   _______  _______  __   __  _______  _______  __    _  _______  ___             #
#  |       ||       ||  | |  ||       ||   _   ||  |  | ||       ||   |            #
#  |  _____||  _____||  |_|  ||    _  ||  |_|  ||   |_| ||    ___||   |            #
#  | |_____ | |_____ |       ||   |_| ||       ||       ||   |___ |   |            #
#  |_____  ||_____  ||       ||    ___||       ||  _    ||    ___||   |___         #
#   _____| | _____| ||   _   ||   |    |   _   || | |   ||   |___ |       |        #
#  |_______||_______||__| |__||___|    |__| |__||_|  |__||_______||_______|        #
#                                                                                  #
#     Website: https://sshpanel.io                                                 #
#     Contact: contact@sshpanel.io                                                 #
#                                                                                  #
#     Support SSHPANEL.IO fight COVID-19 by displaying SSHPANEL.IO URL-            #
#     On your Panel!                                                               #
#                                                                                  #
# ##################################################################################
');

        $this->comment("Welcome to SSHPANEL™ SoftEther Panel Installation!");

        $panelName = 'SOFTETHER PANEL 1.0';

        $this->info(sprintf("%s is nice! congratulations! 🥳", $panelName));

        $this->line('');

        $this->comment("Setup your first admin to login to the panel! 😀");
        $userName      = 'SSHPANEL ADMIN';
        $userEmail     = 'admin@sshpanel.io';
        $userPassword  = 'password';

        $supportPanel  = true;

        Setting::where('key', 'panel_name')->update(['value' => $panelName]);

        if( $supportPanel ) {
            Setting::where('key', 'display_sshpanel_support')->update(['value' => true]);
        }

        User::updateOrCreate(
            [
                'email' => $userEmail
            ],
            [
                'email'     => $userEmail,
                'name'      => $userName,
                'password'  => bcrypt($userPassword),
                'role'      => 'admin'
            ]
        );

        $this->info(sprintf("Setup Success! 👌"));

        if( $supportPanel ) {
            $this->line('');
            $this->info("Thanks for supporting us! 🎉🎉");
            $this->info("SSHPANEL.IO will support COVID-19 by donating 20% of sales to those needed it in Malaysia & Indonesia!");
            $this->info("Thank you for your support! 🙏");

        }

        $this->setupBaseServer();
    }

    protected function askEmail() {
        $email = $this->ask('Your email ✉️');


        if( ! filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $this->error("That's not an email address! Please try again! ❌");

            return $this->askEmail();
        }

        return $email;
    }

    protected function setupBaseServer() {
        $serverIP = '68.183.180.137';

        $rsa = new RSA();
        $rsa->setComment('sshpanel-key-vault');
        $rsa->setPublicKeyFormat(RSA::PUBLIC_FORMAT_OPENSSH);

        $keys = $rsa->createKey(2048);

        $server = Server::create([
            'name' => 'DEMO SERVER SG',
            'ip'   => $serverIP,
            'public_key'    => $keys['publickey'],
            'private_key'   => $keys['privatekey'],
            'current_state' => 'TO_RUN_SOFTWARE_SCRIPT',
            'status'        => 'Select VPN Software',
        ]);


        // register server to softether software

        $software = ServerUtils::getSoftware('softether-vpn');

        if( $software instanceof ServerHook )  {
            $software->beforeRun($server);
        }

        $payload = encrypt(
            json_encode([
                'server_id'    => $server->id,
                'software_id'  => 'softether-vpn'
            ])
        );

        $updateUrl = route('scripts.server-install.update', [$payload]);
        $hookUrl   = route('scripts.server-install.hooks', [$payload]);

        if( $software instanceof RequireServerInfo ) {
            $software->setServer($server);
        }

        if( $software instanceof ServerHook ) {
            $software->setHookUrl($hookUrl);
            $software->setUpdateUrl($updateUrl);
        }

        // generated script.

        $version = sprintf("%s%s", 1.0, str_repeat(" ", (8 - strlen(1.0))));
        $serverName = $server->name;
        $serverIP   = $server->ip;
        $serverPub  = $server->public_key;

        $generatedScript = <<<EOL
#!/bin/bash

####################################################################################
#   _______  _______  __   __  _______  _______  __    _  _______  ___             #
#  |       ||       ||  | |  ||       ||   _   ||  |  | ||       ||   |            #
#  |  _____||  _____||  |_|  ||    _  ||  |_|  ||   |_| ||    ___||   |            #
#  | |_____ | |_____ |       ||   |_| ||       ||       ||   |___ |   |            #
#  |_____  ||_____  ||       ||    ___||       ||  _    ||    ___||   |___         #
#   _____| | _____| ||   _   ||   |    |   _   || | |   ||   |___ |       |        #
#  |_______||_______||__| |__||___|    |__| |__||_|  |__||_______||_______|        #
#                                                                                  #
#     Installer Version: $version                                                  #
#     Website: https://sshpanel.io                                                 #
#     Contact: contact@sshpanel.io                                                 #
#                                                                                  #
# ##################################################################################


export SSHPANEL_HOOKS="$hookUrl"
export SSHPANEL_UPDATE="$updateUrl"
export SERVER_PUB="$serverPub"
export SERVER_IP="$serverIP"
export SERVER_NAME="$serverName"


EOL;

        $generatedScript .= ServerUtils::getInitScript();

        // get the software script
        $generatedScript .= $software->generateInstallationScript();

        $serverScript = ServerScript::updateOrCreate(
            ['server_id' => $server->id],
            [
                'server_id' => $server->id,
                'script'    =>  encrypt($generatedScript),
                'fetched'   => 0
            ]
        );
    }

}
