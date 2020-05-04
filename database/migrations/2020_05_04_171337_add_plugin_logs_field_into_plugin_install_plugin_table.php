<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPluginLogsFieldIntoPluginInstallPluginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plugin_install_plugins', function (Blueprint $table) {
            $table->text('plugin_logs')->after('plugin_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plugin_install_plugins', function (Blueprint $table) {
            $table->dropColumn('plugin_logs');
        });
    }
}
