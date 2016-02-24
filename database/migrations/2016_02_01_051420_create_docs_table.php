<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();     //创建此文档的用户的id
            $table->integer('checker_id')->unsigned()->nullable()->default(null);        //审核此文档的用户的id
            $table->string('title');
            $table->string('entitle');                  //英文标题
            $table->text('body');
            $table->text('enbody');                     //英文详情
            $table->string('type');
            $table->string('keyword');
            $table->string('permalink');
            $table->unsignedTinyInteger('min_level')->default(1);
            $table->unsignedTinyInteger('state')->default(0);
            $table->string('lang');
            $table->timestamps();                   //创建时间
            $table->index(['title','entitle','keyword', 'permalink']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('docs');
    }
}
