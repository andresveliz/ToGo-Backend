<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\TipoResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Tipo;
use DB;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::orderBy('id', 'desc')->get();
        return TipoResource::collection($tipos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoRequest $request)
    {
        try {
            DB::beginTransaction();

            $tipo = new Tipo();
            $tipo->nombre = $request->input('nombre');
            $tipo->save();

            DB::commit();

            return response()->json([
                'mensaje' => 'El Tipo se guardo exitosamente',
                'tipo' => new TipoResource($tipo)
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
        $tipo = Tipo::findOrFail((int)$id);
        return new TipoResource($tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoRequest $request, $id=0)
    {
        try {
            DB::beginTransaction();

            $tipo = Tipo::findOrFail((int) $id);
            $tipo->nombre = $request->input('nombre');

            $tipo->save();

            DB::commit();

            return response()->json([
                'mensaje' => 'El Tipo se actualizo con éxito',
                'tipo' => new TipoResource($tipo)
            ], Response::HTTP_OK);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            response()->json([
                'mensaje' => 'Error al actualizar, consulte al Administrador' . $e,
            ], Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $tipo = Tipo::findOrFail((int) $id);
        $tipo->delete();

        return response()->json([
            'mensaje' => 'Eliminado con éxito',
        ], Response::HTTP_OK);
    }
}
