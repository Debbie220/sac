<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('123456'),
    ];
});

$factory->defineAs(App\User::class, 'admin', function ($faker) use ($factory){
    $user = $factory->raw(App\User::class);

    $user['role'] = "admin";
    return $user;
});

$factory->defineAs(App\User::class, 'professor', function ($faker) use ($factory){
    $user = $factory->raw(App\User::class);

    $user['role'] = "professor";
    return $user;
});

$factory->defineAs(App\Presentation::class, 'student_presentation', 
        function(Faker\Generator $faker){
    $types = [1, 2, 3, 4, 5];
    $courses = [1, 2, 3];
    $status = ["S", "P"];
    $our_nominee = [true, false];
    $presentation = [
        'professor_name' => $faker->name,
        'owner' => 3,
        'course_id' => $courses[array_rand($courses)],
        'title' => $faker->sentence,
        'type' => $types[array_rand($types)],
        'abstract' => $faker->text,
        'special_notes' => $faker->text,
        'status' => $status[array_rand($status)],
        'our_nominee' => $our_nominee[array_rand($our_nominee)],
    ];

    return $presentation;
});
