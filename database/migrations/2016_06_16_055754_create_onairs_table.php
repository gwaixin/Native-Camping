<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onairs', function (Blueprint $table) {
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
            $table->timestamps();

            $table->foreign('teacher_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('student_id')
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
        Schema::drop('onairs');
    }
}
