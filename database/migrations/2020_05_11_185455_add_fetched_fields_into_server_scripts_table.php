<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFetchedFieldsIntoServerScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('server_scripts', function (Blueprint $table) {
            $table->unsignedSmallInteger('fetched')->default(0)->after('script');
            $table->dateTime('last_fetch')->after('fetched')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('server_scripts', function (Blueprint $table) {
            //
        });
    }
}
