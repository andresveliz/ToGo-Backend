<?php

use App\Models\Restaurante;
use Illuminate\Database\Seeder;

class RestauranteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Restaurante::class, 10)->create();
    }
}
