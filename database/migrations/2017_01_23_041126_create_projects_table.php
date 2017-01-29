<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requester_id');
            $table->string('event_contact_name');
            $table->string('event_contact_phone',12);
            $table->string('address');
            $table->string('secondary_address')->nullable();
            $table->string('city');
            $table->string('state',2);
            $table->string('zipcode',5);
            $table->string('phone',12);
            $table->text('directions');
            $table->text('parking')->nullable();
            $table->text('description');
            $table->enum('day', ['Saturday', 'Sunday']);
            $table->integer('time');
            $table->integer('numVolunteers');
            $table->boolean('family')->default(false);
            $table->text('howUsed');
            $table->string('skills');
            $table->string('materialsRequesterWill')->nullable();
            $table->string('materialsRequesterCannot')->nullable();
            $table->string('materialsCityServe')->nullable();
            $table->boolean('evaluated')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('assigned')->default(false);
            $table->integer('evaluator_id');
            $table->integer('category_id');
            $table->integer('volunteers_needed');
            $table->text('notes')->nullable();
            $table->integer('coordinator_id');
            $table->boolean('confirmed')->default(false);
            $table->text('short_description')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
