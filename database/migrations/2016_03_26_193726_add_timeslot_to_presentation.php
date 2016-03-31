<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeslotToPresentation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presentations', function (Blueprint $table) {
          $table->integer("timeslot")->nullable();

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
          $table->dropColumn("timeslot");
        });
    }
}
