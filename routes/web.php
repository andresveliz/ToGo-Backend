<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Faker\Generator as Faker;

Route::get('/', function (Faker $faker) {
    //$id = App\Models\Pedido::select('id')->get()->random();
    $pedido = App\Models\Pedido::findOrFail(1);
    return $pedido['id'];
    //$id = App\Models\Cliente::all()->random();
    //$idCli = $id['id'];
    // return  App\Models\Pedido::with('cliente')->get();
    //return App\Models\Cliente::where('id', 10)->with('ubicaciones')->get();
    //return $dato;
    // return[
    //     'cliente' => $clientes,
    //     'dato' => $dato
    // ];
    // $cliente = $faker->randomElement($clientes);
    // $ubucacion = App\Models\Ubicacion::where('cliente_id',$cliente)->get('id');
});
