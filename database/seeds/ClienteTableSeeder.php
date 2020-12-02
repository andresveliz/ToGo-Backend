<?php

use App\Models\Cliente;
use App\Models\Ubicacion;
use Illuminate\Database\Seeder;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Faker\Factory as Faker;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=1; $i <=20 ; $i++) {
            factory(Cliente::class, 1)->create();
            factory(Ubicacion::class, 3)->create([
                'direccion' =>  $faker->address,
                'ubicacion' => new Point($faker->randomFloat(8, -90, 90), $faker->randomFloat(8, -180, 180)),
                'referencia' => $faker->text(150),
                'cliente_id' => Cliente::findOrFail($i)
            ]);

        }
    }
}
