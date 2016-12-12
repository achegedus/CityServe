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
    }
}
