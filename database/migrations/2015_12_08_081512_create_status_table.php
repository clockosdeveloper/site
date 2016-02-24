<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('stock');
            $table->unsignedInteger('stock_wait');              //待发行的股权
            $table->decimal('per_stock', 4, 2)->unsigned();         //平均每股所占百分比
            $table->decimal('average_price', 14, 4)->unsigned();     //平均每股交易价格
            $table->unsignedInteger('stock_trade');                 //股权总交易量
            $table->unsignedInteger('experience');
            $table->unsignedInteger('vote');                    //总投票权
            $table->unsignedMediumInteger('quests_done');
            $table->unsignedMediumInteger('quests_doing');
            $table->unsignedSmallInteger('quests_open');
            $table->unsignedMediumInteger('quests_wait');
            $table->unsignedMediumInteger('quests_all');
            $table->unsignedInteger('cash_flow');               //现金流
            $table->unsignedInteger('invested');                //已投资的金额
            $table->unsignedInteger('invest_wait');             //待投资的金额
            $table->unsignedInteger('outcome');
            $table->unsignedInteger('outcome_wait');             //待投资的金额
            $table->unsignedSmallInteger('full_time');          //全职员工数
            $table->unsignedInteger('members');                 //总会员的数
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('status');
    }
}
