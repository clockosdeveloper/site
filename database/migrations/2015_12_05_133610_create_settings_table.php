<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->string('sponsor_code')->default(1);
            $table->string('email_found_me')->default(1);
            $table->string('email_task_published')->default(1);;
        });

        DB::unprepared('CREATE TRIGGER `user_setting_trigger` AFTER INSERT ON `users`
        FOR EACH ROW INSERT INTO settings (`user_id`) VALUES (NEW.id)
        ');

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `user_setting_trigger`');
        Schema::drop('settings');
    }
}
