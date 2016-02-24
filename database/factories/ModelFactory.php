<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(123456),
        'remember_token' => str_random(10),
        'sponsor_code' => str_random(10),
        'avatar' => '/img/avatar.png',
        'location' => $faker->address,
        'settings' => ["foo" => "bar"]
    ];
});

$factory->define(App\Quest::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->paragraph,
        'body' => $faker->text,
        'user_id' => $faker->numberBetween(1,20),
        'difficulty' => $faker->numberBetween(1,5),
        'state' => $faker->numberBetween(0,5),
        'stock' => $faker->numberBetween(0,200000),
        'min_level' => $faker->numberBetween(0,99),
    ];
});

$factory->define(App\Decision::class, function (Faker\Generator $faker) {

    $items = ['tech','capital','feature','other','invest','service','priority','appoint','price'];
    return [
        'title' => $faker->paragraph,
        'body' => $faker->text,
        'user_id' => $faker->numberBetween(1,25),
        'state' => $faker->numberBetween(3,4),
        'min_level' => $faker->numberBetween(0,5),
        'min_level' => $faker->numberBetween(0,5),
        'type' => $items[array_rand($items)],
    ];
});

