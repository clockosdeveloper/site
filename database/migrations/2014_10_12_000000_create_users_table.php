<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::blueprintResolver(function(){

        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken('token');
            $table->timestamps();
            $table->string('authority');
            $table->text('avatar')->nullable();
            $table->string('profession')->nullable();
            $table->string('sponsor_code')->unique();
            $table->integer('sponsor_id')->default(-5);
            $table->unsignedTinyInteger('sponsor_max')->default(5); //团队人数上限
            $table->text('introduction')->nullable();
            $table->text('github')->nullable();
            $table->text('blog')->nullable();
            $table->text('company')->nullable();
            $table->string('location')->nullable();
            $table->integer('experience')->default(0)->unsigned();
            $table->tinyInteger('level')->default(1)->unsigned();
            $table->integer('stock')->default(0)->unsigned();
            $table->integer('vote')->default(0)->unsigned();            //总的投票权
            $table->integer('voting')->default(0)->unsigned();          //正在投票的数
            $table->json('settings');
            $table->unsignedTinyInteger('type')->default(0);            //用户类型
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
