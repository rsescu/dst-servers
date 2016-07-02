<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('server_id')->unsigned();
            $table->primary(['user_id', 'server_id']);
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('server_id')->references('server_id')->on('servers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
    }
}
