<?php

use Illuminate\Database\Seeder;
use App\Models\Tipo;

class TipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tipo::class, 15)->create();

    }
}
