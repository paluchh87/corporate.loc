<?php

use Faker\Generator as Faker;

$categories = [
    0 => ['title' => 'Blog', 'alias' => 'blog',],
    1 => ['title' => 'Computers', 'alias' => 'computers', 'parent_id'=>1],
    2 => ['title' => 'Interesting', 'alias' => 'interesting','parent_id'=>1],
    3 => ['title' => 'Tips', 'alias' => 'tips','parent_id'=>1]
];

//$categories = [
//    0 => ['title' => 'Блог', 'alias' => 'blog',],
//    1 => ['title' => 'Компьютеры', 'alias' => 'computers', 'parent_id'=>1],
//    2 => ['title' => 'Интересное', 'alias' => 'interesting','parent_id'=>1],
//    3 => ['title' => 'Советы', 'alias' => 'tips','parent_id'=>1]
//];

$factory->define(Corp\Category::class, function (Faker $faker) use (&$categories) {
    $menuItem=array_shift($categories);
    $parent=0;
    if (isset($menuItem['parent_id'])){
        $parent=$menuItem['parent_id'];
    }

    return [
        'title' => $menuItem['title'],
        'alias' => $menuItem['alias'],
        'parent_id' => $parent
    ];
});
