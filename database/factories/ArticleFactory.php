<?php

use Faker\Generator as Faker;

$factory->define(Corp\Article::class, function (Faker $faker) {
    $user = \Corp\User::select('id')->get()->random();
    $category = \Corp\Category::select('id')->where('parent_id', '!=', 0)->get()->random();

    return [
        'title' => $faker->text(50),
        'text' => $faker->text(2000),
        'desc' => $faker->text(300),
        'keywords' => $faker->text(50),
        'meta_desc' => $faker->text(50),
        'img' => 'default.jpg',
        'user_id' => $user['id'],
        'category_id' => $category['id'],
        'alias' => 'article-' .$faker->unique()->word.'-'. $faker->numberBetween(10, 5000)
    ];
});
