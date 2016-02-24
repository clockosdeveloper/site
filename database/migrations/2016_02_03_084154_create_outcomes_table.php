<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcomes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('checker_id')->nullable()->default(null);
            $table->string('title');
            $table->string('type');
            $table->string('provider');
            $table->text('body');
            $table->unsignedInteger('amount');
            $table->decimal('price', 14, 4)->unsigned();
            $table->unsignedTinyInteger('state')->default(0);
            $table->decimal('average', 14, 4)->unsigned();
            $table->timestamps();
            $table->timestamp('start')->nullable()->default(null);
            $table->timestamp('end')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('outcomes');
    }
}
