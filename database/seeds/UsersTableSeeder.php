<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'first_name' => 'Adam',
            'last_name' => 'Hegedus',
            'email' => 'adam@heged.us',
            'password' => bcrypt('asdfasdf'),
            'phone' => '8149338336',
            'address' => '121 Kaywood Drive',
            'city' => 'Boalsburg',
            'state' => 'PA',
            'zipcode' => '16827',
            'church_id' => 1

        ]);


        DB::table('role_user')->truncate();

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);

    }
}
