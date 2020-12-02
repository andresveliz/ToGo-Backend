<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Point;

$factory->define(\App\Models\Ubicacion::class, function (Faker $faker) {
    return [
        'direccion' =>  $faker->address,
        'ubicacion' => new Point($faker->randomFloat(8, -16, 16), $faker->randomFloat(8, -68, 68)),
        'referencia' => $faker->text(150),
        'cliente_id' => function(){
            return App\Models\Cliente::all()->random();
        }
    ];
});
