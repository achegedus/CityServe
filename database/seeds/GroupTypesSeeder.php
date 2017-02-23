<?php

use Illuminate\Database\Seeder;

class GroupTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('group_types')->insert([
            'name' => 'Life Group'
        ]);

        DB::table('group_types')->insert([
            'name' => 'Small Group'
        ]);

        DB::table('group_types')->insert([
            'name' => 'Family'
        ]);

        DB::table('group_types')->insert([
            'name' => 'Other'
        ]);

    }
}
