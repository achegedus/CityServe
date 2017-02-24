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
        DB::table('users')->insert([
            'name' => 'Adam Hegedus',
            'email' => 'adam@heged.us',
            'password' => bcrypt('asdfasdf'),
            'phone' => '(814)933-8336',
        ]);

        DB::table('users')->insert([
            'name' => 'Adam Hegedus Test',
            'email' => 'adam@adamhegedus.com',
            'password' => bcrypt('asdfasdf'),
            'phone' => '(814)933-8336',
        ]);

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);

        DB::table('role_user')->insert([
            'user_id' => 2,
            'role_id' => 2
        ]);
    }
}
