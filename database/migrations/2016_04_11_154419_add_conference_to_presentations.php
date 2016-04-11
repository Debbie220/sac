<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConferenceToPresentations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presentations', function (Blueprint $table) {
            $table->integer('conference_id')->unsigned();

            $table->foreign('conference_id')->
                references('id')->on('conferences')->
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
        Schema::table('presentations', function (Blueprint $table) {
            $table->dropForeign('presentations_conference_id_foreign');
            $table->dropColumn('conference_id');
        });
    }
}
