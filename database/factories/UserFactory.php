<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'avata' => $faker->image($dir = '/tmp', $width = 640, $height = 480),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'password' => $faker->password                ,
        'category_id' => $faker->$faker->biasedNumberBetween($min = 1, $max = 20, $function = 'sqrt'),
        'user_id' => $faker->$faker->biasedNumberBetween($min = 1, $max = 20, $function = 'sqrt'),
        'email' => $faker->email,
        'remember_token' => str_random(10),
    ];
});
