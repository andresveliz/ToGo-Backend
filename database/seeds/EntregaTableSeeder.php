<?php

use Illuminate\Database\Seeder;
use App\Models\Entrega;

class EntregaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Entrega::class, 10)->create();
    }
}
