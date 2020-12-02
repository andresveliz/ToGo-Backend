<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        # Crear Roles
        $this->call(RoleTableSeeder::class);
        # Crear Restaurante
        $this->call(RestauranteTableSeeder::class);
        # Crear Usuarios
        $this->call(UserTableSeeder::class);
        # Crear Repartiores
        $this->call(RepartidorTableSeeder::class);
        # Crear Categorias
        $this->call(CategoriaTableSeeder::class);
        # Crear Cliente
        $this->call(ClienteTableSeeder::class);
        # Crear Ubicacion
        //$this->call(UbicacionTableSeeder::class);
        # Crear Tipos
        $this->call(TipoTableSeeder::class);
        # Crear Productos
        $this->call(ProductoTableSeeder::class);
        # Crear Pedidos
        $this->call(PedidoTableSeeder::class);
        # Crear PedidoProducto (Tabla pivote)
        $this->call(PedidoProductoTableSeeder::class);
        # Crear Entregas
        $this->call(EntregaTableSeeder::class);
        # Asignar categorias al Restaturante
        $this->call(CategoriaRestauranteTableSeeder::class);

    }
}
