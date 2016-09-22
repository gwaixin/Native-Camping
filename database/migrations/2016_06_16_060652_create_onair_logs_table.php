<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnairLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onair_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->tinyInteger('status');
            $table->tinyInteger('connect_flg');
            $table->string('chat_hash')->unique();
            $table->dateTime('wait_start_time');
            $table->dateTime('wait_end_time');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->tinyInteger('lesson_type');
            $table->tinyInteger('web_rtc_type');
            $table->tinyInteger('lesson_finish');
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
        Schema::drop('onair_logs');
    }
}
