<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Corp\User::class, function (Faker $faker) {
    return [
        'name' => 'user',
        'login'=>'user',
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$yF2TJMxGybDIF2ft3lHS7.7lHXtTC3GM7Cgyxb2jjSa52jAIyYrqq', // 123456
        'remember_token' => str_random(10),
    ];
});
