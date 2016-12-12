<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('roles')->insert([
            'name' => 'SuperAdmin',
            'description' => 'This is an access level limited to users who can modify data at the 
            database level.  Proceed with caution.'
        ]);

        DB::table('roles')->insert([
            'name' => 'Reviewer',
            'description' => 'Person affiliated with CityServe, and is responsible for reviewing and 
            approving work projects.'
        ]);

        DB::table('roles')->insert([
            'name' => 'ChurchContact',
            'description' => 'Primary CityServe point of contact for a church.'
        ]);

        DB::table('roles')->insert([
            'name' => 'ProjectSubmitter',
            'description' => 'Submitter of a work project. Projects submitted will require approval.'
        ]);

        DB::table('roles')->insert([
            'name' => 'Volunteer',
            'description' => 'Person signed up to work on a project.'
        ]);

        DB::table('roles')->insert([
            'name' => 'VolunteerGroupContact',
            'description' => 'Contact person for a volunteer group sign up.'
        ]);
    }
}
