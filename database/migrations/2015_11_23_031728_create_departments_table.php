<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('fullname');
            $table->timestamps();
            $table->integer('parent_id')->unsigned();
            $table->text('logo');
            $table->tinyInteger('level')->unsigned();
        });

        Schema::create('department_quest', function(Blueprint $table)
        {
            $table->integer('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->integer('quest_id')->unsigned()->index();
            $table->foreign('quest_id')->references('id')->on('quests')->onDelete('cascade');
        });

        Schema::create('decision_department', function(Blueprint $table)
        {
            $table->integer('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->integer('decision_id')->unsigned()->index();
            $table->foreign('decision_id')->references('id')->on('decisions')->onDelete('cascade');
        });

        Schema::create('department_doc', function(Blueprint $table)
        {
            $table->integer('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->integer('doc_id')->unsigned()->index();
            $table->foreign('doc_id')->references('id')->on('docs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('department_doc');
        Schema::drop('decision_department');
        Schema::drop('department_quest');
        Schema::drop('departments');
    }
}
