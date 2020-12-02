<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PedidoProductoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($j = 1; $j <= 10; $j++) {
            $pedido = App\Models\Pedido::findOrFail($j);
            $x = $faker->numberBetween(1, 4);
            for ($i = 1; $i <= $x; $i++) {
                $producto = App\Models\Producto::select('id')->get()->random();
                DB::table('pedido_producto')->insert([
                    'pedido_id' => $pedido['id'],
                    'producto_id' => $producto['id'],
                    'cantidad' => $faker->numberBetween(1, 10),
                    'sub_total' => 0
                ]);
            }
        }
    }
}
