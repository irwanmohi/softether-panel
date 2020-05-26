<?php

use Illuminate\Database\Seeder;

use App\Setting;

class BasePanelConfiguration extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'display_name' => 'Panel Name',
                'key'          => 'panel_name',
                'value'        => 'SOFTETHER PANEL',
                'kind'         => 'string'
            ],
            [
                'display_name' => 'Display SSHPANEL Support',
                'key'          => 'display_sshpanel_support',
                'value'        => false,
                'kind'         => 'boolean'
            ]
        ];

        foreach($settings as $setting) {
            Setting::updateOrCreate(
                [
                    'key' => $setting['key']
                ],
                $setting
            );
        }
    }
}
