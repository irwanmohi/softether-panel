<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllowAccountCreationFieldIntoSoftetherServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('softether_servers', function (Blueprint $table) {
            $table->boolean('allow_account_creation')->default(true)->after('passwordless_only');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('softether_servers', function (Blueprint $table) {
            $table->dropColumn('allow_account_creation');
        });
    }
}
