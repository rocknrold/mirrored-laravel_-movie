<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FilmProducer;
use Faker\Generator as Faker;

$factory->define(FilmProducer::class, function (Faker $faker) {
    return [
        'film_id'=> App\Film::inRandomOrder()->first()->getKey(),
    	'producer_id'=> App\Producer::inRandomOrder()->first()->getKey(),
    ];
});
