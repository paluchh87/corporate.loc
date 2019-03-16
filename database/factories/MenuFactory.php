<?php

use Faker\Generator as Faker;

$menus = [
    0 => ['title' => 'Home', 'path' => ''],
    1 => ['title' => 'Blog', 'path' => 'articles',],
    2 => ['title' => 'Portfolio', 'path' => 'portfolios'],
    3 => ['title' => 'Contacts', 'path' => 'contacts'],
    4 => ['title' => 'Admin', 'path' => 'admin'],
    5 => ['title' => 'Computers', 'path' => 'articles/cat/computers', 'parent_id'=>2],
    6 => ['title' => 'Interesting', 'path' => 'articles/cat/interesting','parent_id'=>2],
    7 => ['title' => 'Tips', 'path' => 'articles/cat/tips','parent_id'=>2]
];
//$menus = [
//    0 => ['title' => 'Главная', 'path' => ''],
//    1 => ['title' => 'Блог', 'path' => 'articles',],
//    2 => ['title' => 'Портфолио', 'path' => 'portfolios'],
//    3 => ['title' => 'Контакты', 'path' => 'contacts'],
//    4 => ['title' => 'Админка', 'path' => 'admin'],
//    5 => ['title' => 'Компьютеры', 'path' => 'articles/cat/computers', 'parent_id'=>2],
//    6 => ['title' => 'Интересное', 'path' => 'articles/cat/interesting','parent_id'=>2],
//    7 => ['title' => 'Советы', 'path' => 'articles/cat/tips','parent_id'=>2]
//];

$factory->define(Corp\Menu::class, function (Faker $faker) use (&$menus) {
    $menuItem=array_shift($menus);
    $parent=0;
    if (isset($menuItem['parent_id'])){
        $parent=$menuItem['parent_id'];
    }

    return [
        'title' => $menuItem['title'],
        'path' => $menuItem['path'],
        'parent' => $parent
    ];
});
