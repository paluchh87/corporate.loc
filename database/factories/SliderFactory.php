<?php

use Faker\Generator as Faker;

$factory->define(Corp\Slider::class, function (Faker $faker) {

    return [
        'desc' => $faker->text(255),
        'title' => $faker->text(25),
        'img' => 'default.jpg'
    ];
});
