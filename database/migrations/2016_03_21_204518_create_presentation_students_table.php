<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresentationStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentation_students', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('presentation_id')->unsigned();
            $table->string('student_name');
            $table->unique(['presentation_id', 'student_name']);
            $table->foreign('presentation_id')->
                references('id')->on('presentations')->
                onUpdate('cascade')->
                onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('presentation_students');
    }
}
