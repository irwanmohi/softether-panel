<?php

namespace App\Console\Commands;

use App\User;
use App\Setting;
use Illuminate\Console\Command;

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

        $panelName = $this->ask("Give your panel a name!");

        $this->info(sprintf("%s is nice! congratulations! 🥳", $panelName));

        $this->line('');

        $this->comment("Setup your first admin to login to the panel! 😀");
        $userName      = $this->ask('What is your name 🎫');
        $userEmail     = $this->askEmail();
        $userPassword  = $this->secret('Password (input will be hidden) 🔐');

        $supportPanel  = $this->confirm("Do you want to support us fighting for COVID-19 by displaying sshpanel.io URL on your panel? 🥺");

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
    }

    protected function askEmail() {
        $email = $this->ask('Your email ✉️');


        if( ! filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $this->error("That's not an email address! Please try again! ❌");

            return $this->askEmail();
        }

        return $email;
    }
}
