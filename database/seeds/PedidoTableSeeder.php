<?php

use App\Models\Pedido;
use Illuminate\Database\Seeder;

class PedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Pedido::class, 10)->create();
    }
}
