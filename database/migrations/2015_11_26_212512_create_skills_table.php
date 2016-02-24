<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('fullname');
            $table->timestamps();
            $table->integer('parent_id')->unsigned();
            $table->unsignedInteger('available');           //当前拥有此技能且没有在执行任务的用户数
            $table->text('logo');
            $table->tinyInteger('level')->unsigned();
        });

        Schema::create('skill_user', function(Blueprint $table)
        {
            $table->integer('skill_id')->unsigned()->index();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['user_id','skill_id']);
            $table->timestamps();
            $table->unsignedInteger('experience')->default(0);
            $table->unsignedTinyInteger('level')->default(1);
        });

        Schema::create('quest_skill', function(Blueprint $table)
        {
            $table->integer('skill_id')->unsigned()->index();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->integer('quest_id')->unsigned()->index();
            $table->foreign('quest_id')->references('id')->on('quests')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('decision_skill', function(Blueprint $table)
        {
            $table->integer('skill_id')->unsigned()->index();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->integer('decision_id')->unsigned()->index();
            $table->foreign('decision_id')->references('id')->on('decisions')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('skill_user');
        Schema::drop('quest_skill');
        Schema::drop('decision_skill');
        Schema::drop('skills');
    }
}
