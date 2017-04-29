<?php

use Illuminate\Database\Seeder;

class EvaluatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('evaluators')->insert([
            'name' => 'Jim Leaman',
            'email' => 'leamanguate@gmail.com',
            'phone' => '8145740707'
        ]);

        DB::table('evaluators')->insert([
            'name' => 'John Varner',
            'email' => 'johnpvarner@gmail.com',
            'phone' => '8149339497'
        ]);

        DB::table('evaluators')->insert([
            'name' => 'Mike Prinkey',
            'email' => 'mip103@gmail.com',
            'phone' => '8142807888'
        ]);

        DB::table('evaluators')->insert([
            'name' => 'Dan Johnstonbaugh',
            'email' => 'dxj06@hotmail.com',
            'phone' => '8143601473'
        ]);

        DB::table('evaluators')->insert([
            'name' => 'Erin Harclerode',
            'email' => 'erin.harclerode@gmail.com',
            'phone' => '7173817094'
        ]);

        DB::table('evaluators')->insert([
            'name' => 'Jorn Jonud',
            'email' => 'jorn@calvarysc.org',
            'phone' => '8143598712'
        ]);

        DB::table('evaluators')->insert([
            'name' => 'Kendra Gettig',
            'email' => 'kendra@calvarysc.org',
            'phone' => '8145718293'
        ]);
    }
}
