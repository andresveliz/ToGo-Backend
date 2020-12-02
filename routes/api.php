<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
	Route::post('admin/access/login', 'ApiAuth\LoginController@login');
	Route::post('togo/usuario/newUser','Admin\UsuarioController@newUser');
	Route::post('togo/cliente', 'Admin\ClieteController@store');

});

Route::middleware('auth:api')->group(function () {
    Route::post('admin/access/logout', 'ApiAuth\LoginController@logout');
    Route::get('admin/access/user', 'ApiAuth\LoginController@currentUser');
    Route::put('admin/access/password', 'Admin\UsuarioController@changePassword');
});

Route::middleware('auth:api')->group(function () {
	Route::get('togo/restaurantes', 'Admin\RestauranteController@index');
	Route::get('togo/datos', 'Admin\RestauranteController@restaurante');
	Route::post('togo/restaurante', 'Admin\RestauranteController@store');
	Route::get('togo/restaurante/{restaurante}', 'Admin\RestauranteController@show');
    Route::post('togo/restaurante/{restaurante}', 'Admin\RestauranteController@update');
    //actualizar marcelo
    Route::patch('togo/restaurante/{restaurante}', 'Admin\RestauranteController@update');
	Route::delete('togo/restaurante/{restaurante}/destroy', 'Admin\RestauranteController@destroy');
	Route::patch('togo/restaurante/cambiar-estado/{id}', 'Admin\RestauranteController@cambiarEstado');

	Route::get('togo/categorias', 'Admin\CategoriaController@index');
	Route::post('togo/categoria', 'Admin\CategoriaController@store');
	Route::get('togo/categoria/{categoria}', 'Admin\CategoriaController@show');
	Route::put('togo/categoria/{categoria}', 'Admin\CategoriaController@update');
	Route::delete('togo/categoria/{categoria}/destroy', 'Admin\CategoriaController@destroy');

	Route::get('togo/productos/{id}', 'Admin\ProductoController@index');
	Route::post('togo/producto', 'Admin\ProductoController@store');
	Route::get('togo/producto/{producto}', 'Admin\ProductoController@show');
	Route::put('togo/producto/{producto}', 'Admin\ProductoController@update');
	Route::delete('togo/producto/{producto}/destroy', 'Admin\ProductoController@destroy');
    Route::get('togo/mas-vendidos/{id}','Admin\ProductoController@productosMasVendido');

	Route::get('togo/tipos', 'Admin\TipoController@index');
	Route::post('togo/tipo', 'Admin\TipoController@store');
	Route::get('togo/tipo/{tipo}', 'Admin\TipoController@show');
	Route::put('togo/tipo/{tipo}', 'Admin\TipoController@update');
	Route::delete('togo/tipo/{tipo}/destroy', 'Admin\TipoController@destroy');

	Route::get('togo/usuarios/{id}', 'Admin\UsuarioController@index');
	Route::post('togo/usuario', 'Admin\UsuarioController@store');
	Route::get('togo/usuario/{usuario}', 'Admin\UsuarioController@show');
	Route::put('togo/usuario/{usuario}', 'Admin\UsuarioController@update');
    Route::delete('togo/usuario/{usuario}/destroy', 'Admin\UsuarioController@destroy');

    Route::get('togo/repartidores', 'Admin\RepartidorController@index');
	Route::post('togo/repartidor', 'Admin\RepartidorController@store');
	Route::get('togo/repartidor/{repartidor}', 'Admin\RepartidorController@show');
	Route::put('togo/repartidor/{repartidor}', 'Admin\RepartidorController@update');
    Route::put('togo/repartidor/switch-off/{id}', 'Admin\RepartidorController@enRuta');
    Route::patch('togo/repartidor/cambiar-estado/{id}', 'Admin\RepartidorController@cambiarEstado');
    Route::delete('togo/repartidor/{repartidor}/destroy', 'Admin\RepartidorController@destroy');
    Route::get('togo/repartidor/entregas/{id}', 'Admin\RepartidorController@entregas');

    Route::get('togo/pedidos/{id}', 'Admin\PedidoController@index');
	// Route::post('togo/repartidor', 'Admin\RepartidorController@store');
	Route::get('togo/pedido/{pedido}', 'Admin\PedidoController@show');
	// Route::put('togo/repartidor/{repartidor}', 'Admin\RepartidorController@update');
    // Route::delete('togo/repartidor/{repartidor}/destroy', 'Admin\RepartidorController@destroy');

    Route::get('togo/entregas', 'Admin\EntregaController@index');
    Route::post('togo/entrega', 'Admin\EntregaController@store');
	Route::patch('togo/entrega/cambiar-estado/{id}', 'Admin\EntregaController@cambiarEstado');
	
	
	Route::patch('togo/cliente/{cliente}', 'Admin\ClieteController@update');
	Route::delete('togo/cliente/{cliente}/destroy', 'Admin\ClieteController@destroy');
});


