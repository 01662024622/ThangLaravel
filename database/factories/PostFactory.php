<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'image'=>$faker->imageUrl($width = 640, $height = 480),
        'description'=>$faker->sentence($nbWords = 10, $variableNbWords = true),
        'content'=>$faker->sentence($nbWords = 60, $variableNbWords = true),
        'category_id'=>$faker->biasedNumberBetween($min = 1, $max = 20, $function = 'sqrt'),
        'user_id'=>$faker->biasedNumberBetween($min = 1, $max = 20, $function = 'sqrt'),
        'status'=>$faker->biasedNumberBetween($min = 0, $max = 2, $function = 'sqrt'),
    ];
});
