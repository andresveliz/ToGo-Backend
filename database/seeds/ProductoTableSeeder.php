<?php

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Producto::class, 20)->create();
    }
}
