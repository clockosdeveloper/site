<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('checker_id')->unsigned();
            $table->text('body');
            $table->unsignedTinyInteger('state')->default(0);
            $table->string('type');
            $table->decimal('price', 14, 4)->unsigned();            //交易价格
            $table->integer('stock');
            $table->integer('experience');
            $table->integer('vote');
            $table->decimal('average_price', 14, 4)->unsigned();     //平均每股交易价格
            $table->decimal('per_stock', 4, 2)->unsigned();         //在获得股权当时所占的百分比
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
        Schema::drop('invests');
    }
}
