<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsLockedIntoSoftetherAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('softether_accounts', function (Blueprint $table) {
            $table->boolean('is_locked')->default(false)->after('auth_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('softether_accounts', function (Blueprint $table) {
            $table->dropColumn('is_locked');
        });
    }
}
