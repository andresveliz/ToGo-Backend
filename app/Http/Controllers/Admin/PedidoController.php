<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\PedidoResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=0)
    {
        $pedidos = Pedido::where('cliente_id','=',$id)->orderBy('fecha', 'desc')->get();
        return PedidoResource::collection($pedidos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $pedido = new Pedido();

            $pedido->fecha = $request->input('fecha');
            $pedido->total = $request->input('total');
            $pedido->ubicacion_id = (int) $request->input('ubicacion_id');
            $pedido->cliente_id = (int) $request->input('cliente_id');
            $pedido->restaurante_id = (int) $request->input('restaurante_id'); 

            $pedido->save();

            $productos = $request->productos ? $request->productos : [];
            $pedido->productos()->sync($productos);

            DB::commit();

            return response()->json([
                'mensaje' => 'Los datos se guardaron exitosamente',
                'restaurante' => new PedidoResource($pedido)
            ], Response::HTTP_CREATED);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            response()->json([
                'mensaje' => 'Error al guardar, consulte al Administrador' . $e,
            ], Response::HTTP_FORBIDDEN);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=0)
    {
        $pedido = Pedido::findOrFail((int) $id);
        return new PedidoResource($pedido);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
