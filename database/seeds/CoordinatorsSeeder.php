<?php

use Illuminate\Database\Seeder;

class CoordinatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('coordinators')->insert([
            'name' => 'Shelby Caraway',
            'phone' => 'shelby@calvarysc.org',
            'email' => '6163351814'
        ]);

        DB::table('coordinators')->insert([
            'name' => 'Ann Johnstonbaugh',
            'phone' => 'maj03@hotmail.com',
            'email' => '8143601228  '
        ]);

        DB::table('coordinators')->insert([
            'name' => 'Erin Harclerode',
            'phone' => 'erin.harclerode@gmail.com',
            'email' => '7173817094'
        ]);

        DB::table('coordinators')->insert([
            'name' => 'Matt Seybert (I hope!)',
            'phone' => 'mseybert08@gmail.com',
            'email' => '8145716204'
        ]);

        DB::table('coordinators')->insert([
            'name' => 'Meagan Seibel',
            'phone' => 'mseibel06@gmail.com',
            'email' => '8143803233'
        ]);

        DB::table('coordinators')->insert([
            'name' => 'Titus Morehead',
            'phone' => 'titus.morehead@gmail.com',
            'email' => '8145748438'
        ]);

        DB::table('coordinators')->insert([
            'name' => 'Kyra Quinn',
            'phone' => 'kyra@calvarysc.org',
            'email' => '8144048218'
        ]);

        DB::table('coordinators')->insert([
            'name' => 'Betty Lou Morgan',
            'phone' => 'cr.compassion.connect@gmail.com',
            'email' => '8143084513'
        ]);

        DB::table('coordinators')->insert([
            'name' => 'Beckie Romig',
            'phone' => 'beckieromig@gmail.com',
            'email' => '8145746504 '
        ]);

        DB::table('coordinators')->insert([
            'name' => 'Kendra Gettig',
            'phone' => 'kendra@calvarysc.org',
            'email' => '8145718293'
        ]);
    }
}
