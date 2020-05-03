<?php

namespace Modules\ResellerModule\Database\Seeders;

use App\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AddResellerModuleGlobalSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $settings = [
            [
                'display_name' => 'Allow Reseller to Create Another Reseller',
                'key' => 'reseller_module_allow_reseller_to_add_another_reseller',
                'value' => true
            ],
            [
                'display_name' => 'Force Reseller to Change Password Upon First Login',
                'key' => 'reseller_module_force_reseller_to_change_password_upon_first_login',
                'value' => false
            ],
            [
                'display_name' => 'Allow Reseller to Generate Coupon Code',
                'key' => 'reseller_module_allow_reseller_to_generate_coupon_code',
                'value' => false
            ]
        ];

        Setting::insert($settings);
    }
}
