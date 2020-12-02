<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClienteResource;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\User;
use App\Models\Cliente;
use DB;

class ClieteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        try	{
            DB::beginTransaction();

            $cliente = new Cliente();

            $cliente->ci = $request->input('ci');
            $cliente->nit = $request->input('nit');
            $cliente->tipo = $request->input('tipo');

            $usuario = User::all()->last()->id;
            $cliente->user_id = $usuario;
            $cliente->save();

            DB::commit();

            return response()->json([
                'mensaje' => 'El Cliente se guardo exitosamente',
                'usuario' => new ClienteResource($cliente)
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
    public function update(Request $request, $id=0)
    {
        try {
            DB::beginTransaction();

            $cliente = Cliente::findOrFail((int) $id);
            $cliente->ci = $request->input('ci');
            $cliente->nit = $request->input('nit');
            $cliente->tipo = $request->input('tipo');
            $cliente->save();

            DB::commit();

            return response()->json([
                'mensaje' => 'El Cliente se actualizo con éxito',
                'usuario' => new UsuarioResource($cliente)
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
        $cliente = Cliente::findOrFail((int) $id);
        $cliente->delete();

        return response()->json([
            'mensaje' => 'Eliminado con éxito',
        ], Response::HTTP_OK);
    }
}
