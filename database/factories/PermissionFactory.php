<?php

use Faker\Generator as Faker;

$permissions = [
    'VIEW_ADMIN',
    'ADD_ARTICLES',
    'UPDATE_ARTICLES',
    'DELETE_ARTICLES',
    'ADMIN_USERS',
    'VIEW_ADMIN_ARTICLES',
    'EDIT_USERS',
    'VIEW_ADMIN_MENU',
    'EDIT_MENU',
    'VIEW_ADMIN_PORTFOLIOS',
    'ADD_PORTFOLIOS',
    'UPDATE_PORTFOLIOS',
    'DELETE_PORTFOLIOS',
];

$factory->define(Corp\Permission::class, function (Faker $faker) use (&$permissions) {

    return [
       'name'=>array_shift($permissions)
    ];
});
