<?php

use Illuminate\Database\Seeder;

class ProjectCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('project_categories')->insert([
            'name' => 'Helping'
        ]);

        DB::table('project_categories')->insert([
            'name' => 'Housekeeping'
        ]);

        DB::table('project_categories')->insert([
            'name' => 'Maintenance'
        ]);

        DB::table('project_categories')->insert([
            'name' => 'Miscellaneous'
        ]);

        DB::table('project_categories')->insert([
            'name' => 'Nursing Home'
        ]);

        DB::table('project_categories')->insert([
            'name' => 'Painting'
        ]);

        DB::table('project_categories')->insert([
            'name' => 'School'
        ]);

        DB::table('project_categories')->insert([
            'name' => 'Yard work'
        ]);
    }
}
