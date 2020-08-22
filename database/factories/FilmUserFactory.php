<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FilmUser;
use Faker\Provider\Base;
use Faker\Generator as Faker;

$factory->define(FilmUser::class, function (Faker $faker) {
    return [
        'film_id'=> App\Film::inRandomOrder()->first()->getKey(),
        'user_id'=> App\User::inRandomOrder()->first()->getKey(),
        'rating' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10),
        'comment' => $faker->realText
    ];
});
