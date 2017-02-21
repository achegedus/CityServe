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
            $table->string('requester_org_name');
            $table->string('requester_contact_name');
            $table->string('requester_address');
            $table->string('requester_city');
            $table->string('requester_state',2);
            $table->string('requester_zipcode',5);
            $table->string('requester_phone',12);
            $table->string('requester_email');
            $table->string('requester_church');
            $table->string('event_contact_name');
            $table->string('event_contact_phone',12);
            $table->string('event_address');
            $table->string('event_secondary_address')->nullable();
            $table->string('event_city');
            $table->string('event_state',2);
            $table->string('event_zipcode',5);
            $table->string('event_phone',12);
            $table->text('directions')->nullable();
            $table->text('parking')->nullable();
            $table->text('description');
            $table->enum('day', ['Saturday', 'Sunday']);
            $table->integer('time');
            $table->integer('numVolunteers');
            $table->boolean('family')->default(false);
            $table->text('howUsed');
            $table->string('skills')->nullable();
            $table->string('materialsRequesterWill')->nullable();
            $table->string('materialsRequesterCannot')->nullable();
            $table->string('materialsCityServe')->nullable();
            $table->boolean('evaluated')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('assigned')->default(false);
            $table->integer('evaluator_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('volunteers_needed')->default(0);
            $table->text('notes')->nullable();
            $table->integer('coordinator_id')->nullable();
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
