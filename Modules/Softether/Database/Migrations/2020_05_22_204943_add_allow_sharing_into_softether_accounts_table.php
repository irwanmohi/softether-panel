<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllowSharingIntoSoftetherAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('softether_accounts', function (Blueprint $table) {
            $table->boolean('allow_sharing')->default(true)->after('sharing_url');
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
            $table->dropColumn('allow_sharing');
        });
    }
}
