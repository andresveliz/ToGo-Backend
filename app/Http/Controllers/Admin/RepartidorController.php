<?php

namespace App\Http\Controllers\Admin;

use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Http\Controllers\Controller;
use App\Http\Requests\RepartidorRequest;
use App\Http\Requests\UsuarioRequest;
use App\Http\Resources\RepartidorResource;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Repartidor;
use App\User;
use DB;

class RepartidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repartidores = Repartidor::orderBy('id', 'desc')->get();
        return RepartidorResource::collection($repartidores);
    }

    public function entregas($id=0)
    {
        $repartidor = Repartidor::with('entregas')->findOrFail((int) $id);
        return new RepartidorResource($repartidor);
    }

    public function enRuta($id=0)
    {
        $repartidor = Repartidor::findOrFail((int) $id);
        $repartidor->estado = false;
        $repartidor->save();

        return response()->json([
            'mensaje' => 'El repartidor se encuentra en ruta',
            'repartidor' => new RepartidorResource($repartidor)
        ], Response::HTTP_OK);

    }

    public function cambiarEstado(RepartidorRequest $request, $id=0)
    {
        $repartidor = Repartidor::findOrFail((int) $id);
        if($request->input('estado') == 0)
        {
            $mensaje = 'El repartidor esta fuera de servicio';
            $repartidor->estado = false;
        }
        else
        {
            $mensaje = 'El repartidor esta en servicio';
            $repartidor->estado = true;
        }

        $repartidor->ubicacion = new Point($request->ubicacion['latitude'],$request->ubicacion['longitude']);
        $repartidor->save();

        return response()->json([
            'mensaje' => $mensaje,
            'repartidor' => new RepartidorResource($repartidor)
        ], Response::HTTP_OK);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RepartidorRequest $request)
    {
        try {
            DB::beginTransaction();

            $usuario = new User();

            $usuario->name = $request->input('nombre');
            $usuario->apellidos = $request->input('apellidos');
            $usuario->email = $request->input('email');
            $usuario->telefono = $request->input('telefono');
            $usuario->password = bcrypt($request->input('password'));
            $usuario->restaurante_id = null;
            $usuario->save();
            $usuario->assignRole('Repartidor');

            $repartidor = new Repartidor();

            $repartidor->ruat = $request->input('ruat');
            $repartidor->nit = $request->input('nit');
            $repartidor->estado = 1;
            $repartidor->user_id = $usuario->id;

            $repartidor->save();

            DB::commit();

            return response()->json([
                'mensaje' => 'El registro se guardo exitosamente',
                'repartidor' => new RepartidorResource($repartidor)
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
        $repartidor = Repartidor::findOrFail((int) $id);
        return new RepartidorResource($repartidor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RepartidorRequest $request, $id=0)
    {
        // return response()->json(Repartidor::where('user_id', $id)->first('id'));
        try {
            DB::beginTransaction();

            $usuario = User::findOrFail((int) $id);

            $usuario->name = $request->input('nombre');
            $usuario->apellidos = $request->input('apellidos');
            $usuario->email = $request->input('email');
            $usuario->telefono = $request->input('telefono');
            $usuario->restaurante_id = null;
            $usuario->save();
            $usuario->assignRole('Repartidor');

            $data = Repartidor::where('user_id', $usuario->id)->first('id');

            $repartidor = Repartidor::findOrFail((int) $data['id']);

            $repartidor->ruat = $request->input('ruat');
            $repartidor->nit = $request->input('nit');
            $repartidor->estado = 1;

            $repartidor->save();

            DB::commit();

            return response()->json([
                'mensaje' => 'El registro se actualizo exitosamente',
                'repartidor' => new RepartidorResource($repartidor)
            ], Response::HTTP_OK);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            response()->json([
                'mensaje' => 'Error al guardar, consulte al Administrador' . $e,
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
        $repartidor = Repartidor::findOrFail((int) $id);
        $repartidor->delete();

        return response()->json([
            'mensaje' => 'Eliminado con éxito',
        ], Response::HTTP_OK);
    }

    public function storeUser(UsuarioRequest $request)
    {

    }
}
