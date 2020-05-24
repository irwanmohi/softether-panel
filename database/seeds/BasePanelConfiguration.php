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
