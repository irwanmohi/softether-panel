<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftetherServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softether_servers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('server_id');
            $table->unsignedBigInteger('account_price')->default(0);
            $table->text('server_ca')->nullable();
            $table->text('psk')->nullable();
            $table->string('hub_name')->default('DEFAULT');
            $table->text('hub_password');
            $table->text('admin_password');
            $table->boolean('enable_vpn')->default(true);
            $table->boolean('enable_l2tp')->default(true);
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
        Schema::dropIfExists('softether_servers');
    }
}
