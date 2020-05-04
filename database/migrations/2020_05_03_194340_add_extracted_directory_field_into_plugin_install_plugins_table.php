<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtractedDirectoryFieldIntoPluginInstallPluginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plugin_install_plugins', function (Blueprint $table) {
            $table->string('final_path')->after('final_file_name');
            $table->string('extracted_directory')->after('final_path');
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
            $table->dropColumn(['extracted_directory', 'final_path']);
        });
    }
}
