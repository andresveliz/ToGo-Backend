<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Entrega::class, function (Faker $faker) {
    return [
        'observaciones' => $faker->text,
        'estado' => $faker->randomElement(['ENTREGADO', 'PENDIENTE']),
        'repartidor_id' => function(){
            return App\Models\Repartidor::all()->random();
        },
        'pedido_id' => function(){
            return App\Models\Pedido::all()->random();
        }
    ];
});
