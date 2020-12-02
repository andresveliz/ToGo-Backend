<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'roles'
        ]);

        //Crear Roles para poner el sistema en Produccion.
        Role::create(['name' => 'AdminApp']);
        Role::create(['name' => 'AdminRestaurante']);
        Role::create(['name' => 'Empleado1']);
        Role::create(['name' => 'Empleado2']);
        Role::create(['name' => 'Cliente']);
        Role::create(['name' => 'Repartidor']);
    }

    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
