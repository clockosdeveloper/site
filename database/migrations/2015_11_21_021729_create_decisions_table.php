<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDecisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decisions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();                 //创建此决策用户的id
            $table->string('title');
            $table->string('entitle');                              //英文标题
            $table->text('body');
            $table->text('enbody');                                 //英文详情
            $table->string('type');
            $table->unsignedInteger('amount');                      //总的投票数
            $table->unsignedInteger('min_vote')->default(1);                    //最少的投票权
            $table->unsignedTinyInteger('min_level')->default(1);
            $table->unsignedTinyInteger('state')->default(3);
            $table->string('lang');
            $table->timestamp('completed')->default(null);          //投票截止时间
            $table->timestamps();                                   //创建时间

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

        });

        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');     //创建此决策用户的id
            $table->unsignedInteger('decision_id');
            $table->unsignedInteger('option_id');
            $table->unsignedInteger('amount');
            $table->timestamps();

            $table->foreign('decision_id')
                ->references('id')
                ->on('decisions')
                ->onDelete('cascade');

        });

        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('decision_id');
            $table->string('title');
            $table->unsignedInteger('amount')->default(0);

            $table->foreign('decision_id')
                ->references('id')
                ->on('decisions')
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
        Schema::drop('options');
        Schema::drop('votes');
        Schema::drop('decisions');
    }
}
