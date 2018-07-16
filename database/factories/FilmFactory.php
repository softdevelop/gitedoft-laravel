<?php

use Faker\Generator as Faker;

$factory->define(App\Film::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->sentence(5),
        'description' => $faker->text($maxNbChars = 200),
        'realease_date' =>$faker->dateTime($max = 'now', $timezone = null),
        'rating' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5),
        'ticket_price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
        'country' => $faker->country(),
        'genre' => json_encode($faker->words($nb = 3, $asText = false)),
        'photo' => $faker->imageUrl($width = 640, $height = 480),
        'slug' =>str_slug($faker->sentence(5)),
    ];
});
