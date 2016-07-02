<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments("server_id");
            $table->integer("game_id")->unsigned();
            $table->integer('host_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('run_script')->unique();
            $table->string('name');
        });
        Schema::table('servers', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('game_id')->references('game_id')->on('games');
            $table->foreign('host_id')->references('host_id')->on('hosts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('servers');
    }
}
