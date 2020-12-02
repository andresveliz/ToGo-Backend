<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriaRestauranteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($j = 1; $j <= 7; $j++) {
            $categoria = App\Models\Categoria::findOrFail($j);
            DB::table('categoria_restaurante')->insert([
                'restaurante_id' => 1,
                'categoria_id' => $categoria['id'],
            ]);
        }
    }
}
