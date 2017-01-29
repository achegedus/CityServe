<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requesters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('organization');
            $table->string('contact_name');
            $table->string('address');
            $table->string('secondary_address')->nullable();
            $table->string('city');
            $table->string('state',2);
            $table->string('zipcode',5);
            $table->string('email');
            $table->integer('church_id');
            $table->string('short_name');
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
        Schema::dropIfExists('requesters');
    }
}
