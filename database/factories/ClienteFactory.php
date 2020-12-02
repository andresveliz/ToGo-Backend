<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Cliente::class, function (Faker $faker) {
    return [
        'ci' => (string) $faker->randomNumber(),
        'nit' => (string) $faker->randomNumber(),
        'user_id' => function(){
            return App\User::role('Cliente')->get()->random();
        }
    ];
});
