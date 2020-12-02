<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*=== DATOS PARA PRODUCCION (Administrador de la aplicacion)*/
        $user = new User();
        $user->name = 'Administrador';
        $user->apellidos = 'admin';
        $user->telefono = '54364789';
        $user->email = 'admin@gmail.com';
        $user->email_verified_at = Carbon::now();
        $user->password = 'qwerty#ee';
        $user->save();
        $user->syncRoles(1);

        /*=== DATOS PARA PRODUCCION (Administrador de la aplicacion)*/
        $user = new User();
        $user->name = 'Administrador Restaurante';
        $user->apellidos = 'admin';
        $user->telefono = '54364789';
        $user->email = 'admin_restaurante@gmail.com';
        $user->email_verified_at = Carbon::now();
        $user->password = 'qwerty#ee';
        $user->restaurante_id = 1;
        $user->save();
        $user->syncRoles(2);

        // # empleados
        // factory(User::class, 15)->create()->each(function ($user) {
        //     $user->syncRoles(3);
        // });

        # clientes
        factory(User::class, 15)->create()->each(function ($user) {
            $user->syncRoles(5);
        });

        # repartidores
        factory(User::class, 20)->create()->each(function ($user) {
            $user->syncRoles(6);
        });


    }
}
