<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServerSoftwareStatusFieldIntoServerSoftwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('server_software', function (Blueprint $table) {
            $table->boolean('active')->default(false)->after('ports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('server_software', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
}
