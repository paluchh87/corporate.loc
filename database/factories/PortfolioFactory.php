<?php

use Faker\Generator as Faker;

$factory->define(Corp\Portfolio::class, function (Faker $faker) {
    $filter = \Corp\Filter::select('alias')->get()->random();

    return [
        'title' => $faker->text(50),
        'text' => $faker->text(1500),
        'customer' => $faker->word,
        'keywords' => $faker->text(50),
        'meta_desc' => $faker->text(50),
        'img' => 'default.jpg',
        'filter_alias' => $filter['alias'],
        'alias' => 'portfolio-' . $faker->numberBetween(10, 5000)
    ];
});
