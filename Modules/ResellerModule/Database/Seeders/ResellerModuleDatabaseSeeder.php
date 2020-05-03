<?php

namespace Modules\ResellerModule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ResellerModuleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AddResellerModuleGlobalSettingsTableSeeder::class);

        // $this->call("OthersTableSeeder");
    }
}
