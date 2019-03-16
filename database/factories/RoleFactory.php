<?php

use Faker\Generator as Faker;

$roles = [
    'Admin',
    'Moderator',
    'Guest'
];

$factory->define(Corp\Role::class, function (Faker $faker) use (&$roles) {
    $role=array_shift($roles);

    return [
        'name' => $role
    ];
});
