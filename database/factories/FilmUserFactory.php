<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FilmUser;
use Faker\Generator as Faker;

$factory->define(FilmUser::class, function (Faker $faker) {
    return [
        'film_id'=> App\Film::inRandomOrder()->first()->getKey(),
        'user_id'=> App\User::inRandomOrder()->first()->getKey(),
    ];
});
