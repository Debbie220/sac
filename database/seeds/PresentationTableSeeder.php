<?php

use Illuminate\Database\Seeder;

class PresentationTableSeeder extends Seeder
{
    /**
     * Creates presentations and add students to each one.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Presentation::class, 'student_presentation', 5)->
            create()->each(function($p) {
                $faker = Faker\Factory::create();

                $students = [1, 2, 3, 4, 5];
                $total = $students[array_rand($students)];

                for($i = 0; $i < $total; $i++){
                    DB::table('presentation_students')->insert(
                        ['presentation_id' => $p->id,
                        'student_name' => $faker->name]);
                }
            });
    }
}
