<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ActorRole;
use Faker\Generator as Faker;

$factory->define(ActorRole::class, function (Faker $faker) {
    return [
        'actor_id'=> App\Actor::inRandomOrder()->first()->id,
        'role_id'=> App\Role::inRandomOrder()->first()->id,
        'name'=>$faker->word,
        'description' => $faker->text,
    ];
});
