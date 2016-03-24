<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusAttributeToPresentations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presentations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->dropColumn(['submitted', 'approved']);
            $table->string("status", 1);
            $table->foreign("status")->
                references("id")->on("statuses");
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
            $table->dropForeign("presentations_status_foreign");
            $table->dropColumn("status");
            $table->boolean("submitted")->default(false);
            $table->boolean("approved")->default(false);
            $table->boolean("declined")->default(false);
        });
    }
}
