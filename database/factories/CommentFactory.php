<?php

use Faker\Generator as Faker;

$factory->define(Corp\Comment::class, function (Faker $faker) {
    $number = $faker->numberBetween(1, 20);
    if ($number < 7) {
        $user = \Corp\User::select(['id', 'name', 'email'])->get()->random();
        $name = $user['name'];
        $user_id = $user['id'];
        $email = $user['email'];
    } else {
        $name = $faker->name;
        $user_id = null;
        $email = $faker->unique()->safeEmail;
    }

    $article = \Corp\Article::select('id')->get()->random();

    return [
        'name' => $name,
        'text' => $faker->text(200),
        'email' => $email,
        'parent_id' => 0,
        'user_id' => $user_id,
        'article_id' => $article['id'],
    ];
});
