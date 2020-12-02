<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

$factory->define(\App\Models\Categoria::class, function (Faker $faker) {


    $categorias = [
        'Alta Cocina',
        'Buffete',
        'Cafeterias',
        'Catering',
        'Cevicherias',
        'Chicharronerias',
        'Comida China',
        'Churrasquerias',
        'Comida Arabe',
        'Comida Brasilera',
        'Comida Francesa',
        'Comida Gourmet',
        'Comida Internacional',
        'Comida Nacional',
        'Hamburguesas',
        'Heladerias',
        'Pastelerias',
        'Pizzerias',
        'Pollos, Broaster, Spiedo, A la Lenia',
        'Restaurantes'
    ];

    return [
        'nombre' => $faker->unique()->randomElement($categorias),
    ];
});
