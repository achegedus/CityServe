<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class UpdateProjectsForYearly extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('volunteers', function (Blueprint $table) {
            $table->timestamps();
        });

        $date = Carbon::createFromDate(2017, 1, 1);

        DB::table('volunteers')->update(['created_at' => $date, 'updated_at' => $date]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
