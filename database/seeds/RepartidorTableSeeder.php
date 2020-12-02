<?php

use Illuminate\Database\Seeder;
use App\Models\Repartidor;

class RepartidorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Repartidor::class, 20)->create();
    }
}
