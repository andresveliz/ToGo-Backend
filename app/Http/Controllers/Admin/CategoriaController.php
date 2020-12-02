<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\CategoriaResource;
use App\Http\Requests\CategoriaRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\UploadImage;
use App\Models\Categoria;
use DB;


class CategoriaController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::orderBy('id', 'desc')->get();
        return CategoriaResource::collection($categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        try {
            DB::beginTransaction();

            $categoria = new Categoria();
            $categoria->nombre = $request->input('nombre');

            $categoria->save();

            DB::commit();

            return response()->json([
                'mensaje' => 'La Categoria se guardo exitosamente',
                'categoria' => new CategoriaResource($categoria)
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
        $categoria = Categoria::findOrFail((int)$id);
        return new CategoriaResource($categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, $id=0)
    {
        try {
            DB::beginTransaction();

            $categoria = Categoria::findOrFail((int) $id);
            $categoria->nombre = $request->input('nombre');

            $categoria->save();

            DB::commit();

            return response()->json([
                'mensaje' => 'La Categoria se actualizo con éxito',
                'categoria' => new CategoriaResource($categoria)
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
        $categoria = Categoria::findOrFail((int) $id);
        $categoria->delete();

        return response()->json([
            'mensaje' => 'Eliminado con éxito',
        ], Response::HTTP_OK);
    }
}
