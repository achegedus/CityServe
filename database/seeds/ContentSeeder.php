<?php

use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('contents')->insert([
            'short_name' => 'about_us',
            'description' => 'Content on home page - about us section',
            'body' => 'CityServe is a partnership of several local churches to bless our local community. It\'s an opportunity for the church to be the church through practical acts of kindness. We\'re looking forward to completing more than 150 projects using 1500 volunteers during the weekend of May 20 and 21! All types of projects will be requested - painting, yard work, cleaning and organizing, baking, home repair/construction, visiting with folks, hosting events and more. Want to request a project? Please do so April 21! Want to serve? Please register for a project between April 1 and May 8. Volunteers can register as an individual or group.'
        ]);

        DB::table('contents')->insert([
            'short_name' => 'churches',
            'description' => 'Content on home page - churches section',
            'body' => 'CityServe is a multi-church effort. Lots of churches participate. Please consider sending volunteers from your church! Below are a list of churches on the CityServe Planning Team. If you attend one of these churches, please direct your questions toward these representatives. If you would like your church to be part of the planning team, please contact Kendra at kendra@calvarysc.org or 238.0822 ext. 20.'
        ]);

        DB::table('contents')->insert([
            'short_name' => 'project_register',
            'description' => 'Content on project registration page',
            'body' => 'Have a project to request? Please complete the project request form! If you\'re unable to complete the form, please call 814.238.0822 ext 20! All types of projects can be requested - painting, yard work, cleaning and organizing, baking, home repair/construction, visiting with folks, hosting events, roofing repairs and more. While we strive to complete all requested projects, we can\'t commit to that. If you request a painting, home repair, roofing or construction project, you\'ll hear from a CityServe evaluator to schedule an appointment to learn more about your project. Evaluators will determine if your project is within the scope of what CityServe is able to complete. We\'ll notify project requestors at least one week prior to CityServe to confirm if we have volunteers for your project.'
        ]);
    }
}
