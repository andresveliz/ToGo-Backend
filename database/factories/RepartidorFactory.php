<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Point;

$factory->define(\App\Models\Repartidor::class, function (Faker $faker) {
    return [
        'ruat' => (string) $faker->randomNumber(),
        'nit' => (string) $faker->randomNumber(),
        'estado' => $faker->randomElement([true, false]),
        'ubicacion' => new Point($faker->randomFloat(8, -16, 16), $faker->randomFloat(8, -68, 68)),
        'user_id' => function(){
            return App\User::role('Repartidor')->get()->random();
        }
    ];
});
