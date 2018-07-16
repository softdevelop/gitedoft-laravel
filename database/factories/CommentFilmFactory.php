<?php

use Faker\Generator as Faker;

$factory->define(App\CommentFilm::class, function (Faker $faker) {
    return [
        //
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'film_id' => function () {
            return factory(App\Film::class)->create()->id;
        },
        'content' => $faker->text($maxNbChars = 200)
    ];
});
