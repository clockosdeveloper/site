<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->unsignedInteger('stock');
            $table->unsignedInteger('stock_d');
            $table->integer('stock_dd');
            
            $table->unsignedMediumInteger('quests_done');
            $table->unsignedMediumInteger('quests_done_d');
            $table->mediumInteger('quests_done_dd');

            $table->unsignedInteger('members');
            $table->unsignedInteger('members_d');
            $table->integer('members_dd');


            $table->unsignedInteger('stock_trade');
            $table->unsignedInteger('stock_trade_d');
            $table->integer('stock_trade_dd');

            $table->unsignedInteger('invested');
            $table->unsignedInteger('invested_d');
            $table->integer('invested_dd');

            $table->unsignedInteger('outcome');
            $table->unsignedInteger('outcome_d');
            $table->integer('outcome_dd');

            $table->decimal('average_price', 14, 4)->unsigned();
            $table->decimal('average_price_d', 14, 4);
            $table->decimal('average_price_p',4,2);

            $table->unsignedInteger('cash_flow');
            $table->integer('cash_flow_d');
            $table->decimal('cash_flow_p',4,2);

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('weekly');
    }
}
