<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->string('room_code', 6);
            $table->tinyInteger('day')->unsigned();
            $table->string('time', 3);
            $table->integer('presentation_id')->unsigned();

            $table->foreign('presentation_id')->
                references('id')->on('presentations');
            $table->foreign('room_code')->
                references('code')->on('rooms');
            $table->primary(['room_code', 'day', 'time']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedules');
    }
}
