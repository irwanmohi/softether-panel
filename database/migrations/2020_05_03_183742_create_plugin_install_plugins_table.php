<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePluginInstallPluginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugin_install_plugins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plugin_install_id');
            $table->string('file_name');
            $table->string('final_file_name');
            $table->boolean('is_valid')->default(false);
            $table->string('plugin_name')->nullable();
            $table->string('plugin_description')->nullable();
            $table->string('plugin_version')->nullable()->default('Unknown');
            $table->boolean('plugin_premium')->default(false)->nullable();
            $table->string('plugin_status')->default('UPLOADED')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plugin_install_plugins');
    }
}
