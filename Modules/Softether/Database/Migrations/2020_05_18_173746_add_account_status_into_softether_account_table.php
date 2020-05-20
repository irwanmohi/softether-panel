<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountStatusIntoSoftetherAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('softether_accounts', function (Blueprint $table) {
            $table->string('status')->default('CREATING')->after('password');
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
            $table->dropColumn('status');
        });
    }
}
