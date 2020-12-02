<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\EntregaResource;
use App\Http\Requests\EntregaRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Entrega;
use DB;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entregas = Entrega::orderBy('id', 'desc')->get();
        return EntregaResource::collection($entregas);
    }

    public function cambiarEstado($id=0)
    {
        $entrega = Entrega::findOrFail((int) $id);
        $entrega->estado = 1;
        $entrega->save();

        return new EntregaResource($entrega);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntregaRequest $request)
    {
        try {
            DB::beginTransaction();

            $entrega = new Entrega();
            $entrega->pedido_id = (int) $request->input('pedido_id');
            $entrega->repartidor_id = (int) $request->input('repartidor_id');
            $entrega->observaciones = $request->input('observaciones');
            $entrega->estado = 'PENDIENTE';

            $entrega->save();

            DB::commit();

            return response()->json([
                'mensaje' => 'La entrega se asigno exitosamente',
                'entrega' => new EntregaResource($entrega)
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
    public function show($id)
    {
        //
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
