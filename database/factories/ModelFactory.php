<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zipcode' => $faker->postcode,
        'email' => $faker->email,
        'password' => $password ?: $password = bcrypt('secret'),
        'church_id' => $faker->numberBetween(1,5),
        'remember_token' => str_random(10)
    ];
});


$factory->define(App\Models\Group::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->catchPhrase,
        'members' => $faker->numberBetween(3,20),
        'group_type_id' => $faker->numberBetween(1,5),
        'user_id' => $faker->numberBetween(1,15),
        'project_id' => $faker->numberBetween(1,10),
    ];
});


$factory->define(App\Models\Church::class, function (Faker\Generator $faker) {
   return [
       'name' => $faker->company,
       'address' => $faker->streetAddress,
       'address2' => $faker->secondaryAddress,
       'city' => $faker->city,
       'state' => $faker->stateAbbr,
       'zipcode' => $faker->postcode,
       'url' => $faker->url,
       'phone' => $faker->regexify('[1-9]{10}')
   ];
});


$factory->define(App\Models\Project::class, function (Faker\Generator $faker) {
    return [
        'requester_org_name' => $faker->company,
        'requester_contact_name' => $faker->name,
        'requester_address' => $faker->streetAddress,
        'requester_city' => $faker->city,
        'requester_state' => $faker->stateAbbr,
        'requester_zipcode' => $faker->postcode,
        'requester_phone' => $faker->regexify('[1-9]{10}'),
        'requester_email' => $faker->email,
        'requester_church' => $faker->company,
        'event_contact_name' => $faker->name,
        'event_contact_phone' => $faker->regexify('[1-9]{10}'),
        'event_address' => $faker->streetAddress,
        'event_city' => $faker->city,
        'event_state' => $faker->stateAbbr,
        'event_zipcode' => $faker->postcode,
        'event_phone' => $faker->regexify('[1-9]{10}'),
        'directions' => $faker->paragraph(6),
        'parking' => $faker->paragraph(4),
        'description' => $faker->paragraph(8),
        'day' => $faker->randomElement(['saturday' ,'sunday']),
        'time' => (string) $faker->numberBetween(5, 16),
        'numVolunteers' => $faker->numberBetween(1, 15),
        'family' => $faker->boolean(),
        'howUsed' => $faker->paragraph(3),
        'skills' => $faker->paragraph(2),
        'materialsRequesterWill' => $faker->paragraph(2),
        'materialsRequesterCannot' => $faker->paragraph(1),
        'materialsCityServe' => $faker->paragraph(1)
    ];
});