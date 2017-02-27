<?php

use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('churches')->truncate();
        DB::table('projects')->truncate();
        DB::table('groups')->truncate();

        factory(App\Models\Church::class, 5)->create();
        factory(App\Models\Project::class, 10)->create();
        factory(App\Models\Group::class, 5)->create();
    }
}
