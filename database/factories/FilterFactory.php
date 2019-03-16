<?php

use Faker\Generator as Faker;

$factory->define(Corp\Filter::class, function (Faker $faker) {
    $name=$faker->unique()->word;

    return [
        'title' => $name,
        'alias' => 'alias-'.$name
    ];
});
