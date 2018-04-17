<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name'=>$faker->$faker->sentence($nbWords = 2, $variableNbWords = true),
        'parent_id'=>$faker->biasedNumberBetween($min = 0, $max = 5, $function = 'sqrt'),
        'sort_order'=>$faker->biasedNumberBetween($min = 0, $max = 10, $function = 'sqrt'),
    ];
});
