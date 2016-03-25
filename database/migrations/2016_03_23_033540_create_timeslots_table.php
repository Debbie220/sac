<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeslotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeslots', function (Blueprint $table) {
          $table->increments('id');
          $table->string('room_code', 6);
          $table->tinyInteger('day')->unsigned();
          $table->string('time', 5);
          $table->integer('conference_id')->unsigned();

          $table->foreign('room_code')->
              references('code')->on('rooms');
          $table->foreign('conference_id')->
              references('id')->on('conferences');
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
        Schema::drop('timeslots');
    }
}
