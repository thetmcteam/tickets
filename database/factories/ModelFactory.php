<?php

$factory->define(App\Models\Status::class, function (Faker\Generator $faker) {
    return [
        'status' => $faker->name,
        'color' => '#ccc'
    ];
});

$factory->define(App\Models\Priority::class, function (Faker\Generator $faker) {
    return [
        'priority' => $faker->name,
        'color' => '#ccc'
    ];
});

$factory->define(App\Models\Type::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->name,
        'color' => '#ccc'
    ];
});

$factory->define(App\Models\Department::class, function (Faker\Generator $faker) {
    return [
        'department' => $faker->name,
        'color' => '#ccc'
    ];
});

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'username' => $faker->username,
        'password' => bcrypt('secret')
    ];
});

$factory->define(App\Models\Ticket::class, function (Faker\Generator $faker) {
    return [
        'user' => 1,
        'department' => 1,
        'title' => $faker->name,
        'content' => $faker->name,
        'status' => 1,
        'type' => 1
    ];
});
