<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnlineStatusToSoftetherAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('softether_accounts', function (Blueprint $table) {
            $table->string('online_status')->after('allow_sharing')->default('OFFLINE');
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
            $table->dropColumn('online_status');
        });
    }
}
