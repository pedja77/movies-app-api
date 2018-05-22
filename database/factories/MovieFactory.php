<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'director' => $faker->name(),
        'imageUrl' => $faker->imageUrl($width = 200, $height = 200),
        'duration' => $faker->numberBetween($min = 60, $max = 499),
        'releaseDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'genre' => $faker->word()
    ];
});
