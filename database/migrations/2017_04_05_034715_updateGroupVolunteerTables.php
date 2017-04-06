<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGroupVolunteerTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('volunteers', function (Blueprint $table) {
            $table->integer('number_of_volunteers')->default(1);
            $table->integer('group_id')->nullable();
            $table->boolean('leader')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropColumn('number_of_volunteers');
            $table->dropColumn('group_id');
            $table->dropColumn('leader');
        });
    }
}
