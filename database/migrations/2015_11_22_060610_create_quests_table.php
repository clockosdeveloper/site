<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();     //创建此任务用户的id
            $table->integer('checker_id')->unsigned()->nullable()->default(null);        //开发此任务用户的id
            $table->integer('execution_id')->unsigned()->nullable()->default(null);;     //执行此任务用户的id
            $table->integer('final_checker_id')->unsigned()->nullable()->default(null);  //检查任务完成情况用户的id
            $table->integer('priority')->unsigned()->nullable()->default(null);          //任务的优先顺序
            $table->string('title');
            $table->string('entitle');                  //英文标题
            $table->text('body');
            $table->text('enbody');                     //英文详情
            $table->unsignedTinyInteger('difficulty')->default(2);
            $table->string('type');
            $table->unsignedTinyInteger('min_level')->default(1);
            $table->unsignedTinyInteger('state')->default(0);
            $table->unsignedInteger('stock');
            $table->string('fullname');
            $table->string('enfullname');
            $table->string('lang');
            $table->timestamp('published_at');      //任务公开时间
            $table->timestamp('estimated')->nullable()->default(null);         //预计完成时间
            $table->unsignedSmallInteger('days')->default(1);   //预计完成的天数
            $table->timestamp('completed')->nullable()->default(null);         //完成时间
            $table->timestamps();                   //创建时间

            $table->index(['fullname', 'enfullname']);

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quests');
    }
}
