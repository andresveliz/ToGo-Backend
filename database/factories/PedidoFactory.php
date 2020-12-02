<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Pedido::class, function (Faker $faker) {
    $id = App\Models\Cliente::all()->random();
    $idCli = $id['id'];

    return [
        'fecha'=> $faker->date('Y-m-d'),
        'total' => $faker->randomFloat(2, 10, 100),
        'cliente_id' => $idCli,
        'ubicacion_id'=> App\Models\Ubicacion::where('cliente_id',  $idCli)->get()->random(),
        'restaurante_id'=> App\Models\Restaurante::all()->random()
    ];



});
