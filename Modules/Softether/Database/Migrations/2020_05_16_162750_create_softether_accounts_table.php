<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftetherAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softether_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('softether_server_id');
            $table->string('username');
            $table->text('password');
            $table->unsignedBigInteger('price');
            $table->dateTime('active_date');
            $table->dateTime('expired_date');
            $table->text('account_cert')->nullable();
            $table->text('account_key')->nullable();
            $table->string('auth_type')->default('PASSWORD');

            $table->unsignedBigInteger('outgoing_unicast_packets')->default(0);
            $table->unsignedBigInteger('outgoing_unicast_size')->default(0);
            $table->unsignedBigInteger('outgoing_broadcast_packets')->default(0);
            $table->unsignedBigInteger('outgoing_broadcast_size')->default(0);
            $table->unsignedBigInteger('incoming_unicast_packets')->default(0);
            $table->unsignedBigInteger('incoming_unicast_size')->default(0);
            $table->unsignedBigInteger('incoming_broadcast_packets')->default(0);
            $table->unsignedBigInteger('incoming_broadcast_size')->default(0);
            $table->unsignedBigInteger('total_logins')->default(0);

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
        Schema::dropIfExists('softether_accounts');
    }
}
