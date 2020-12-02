<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Point;

$factory->define(\App\Models\Restaurante::class, function (Faker $faker) {
    return [
        'nombre' => $faker->text(25),
        'direccion' => $faker->address,
        'telefono' => $faker->phoneNumber,
        'email' => $faker->email,
        'logo' => 'defult.jpg',
        'descripcion' => $faker->text(150),
        'estado' => $faker->randomElement([true, false]),
        'ubicacion' => new Point($faker->randomFloat(8, -90, 90), $faker->randomFloat(8, -180, 180))
    ];
});
