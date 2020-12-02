<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Producto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word,
        'imagen' => 'default.jpg',
        'descripcion' => $faker->text,
        'precio' => '28.5',
        'restaurante_id' => 1,
        'tipo_id' => function(){
            return App\Models\Tipo::all()->random();
        }
    ];
});
