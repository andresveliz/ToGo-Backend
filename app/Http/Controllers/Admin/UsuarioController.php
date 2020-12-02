<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ChangePasswordUserRequest;
use App\Http\Resources\UsuarioResource;
use App\Http\Requests\UsuarioRequest;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\User;
use DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=0)
    {
        $usuarios = User::where('restaurante_id','=', $id)->orderBy('id', 'desc')->get();
        return UsuarioResource::collection($usuarios);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        // return response()->json($request);
        try {
            DB::beginTransaction();

            $usuario = new User();

            $usuario->name = $request->input('nombre');
            $usuario->apellidos = $request->input('apellidos');
            $usuario->telefono = $request->input('telefono');
            $usuario->email = $request->input('email');
            $usuario->password = $request->input('password');
            $usuario->restaurante_id = $request->input('restaurante_id');
            $usuario->save();

            $roles = $request->roles ? $request->roles : [];
            $usuario->syncRoles($roles);

            DB::commit();

            return response()->json([
                'mensaje' => 'El Usuario se guardo exitosamente',
                'usuario' => new UsuarioResource($usuario)
            ], Response::HTTP_CREATED);
            //return response()->json($request);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            response()->json([
                'mensaje' => 'Error al guardar, consulte al Administrador' . $e,
            ], Response::HTTP_FORBIDDEN);
        }
        // return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=0)
    {
        $usuario = User::findOrFail((int)$id);
        return new UsuarioResource($usuario);
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

            $usuario = User::findOrFail((int) $id);
            $usuario->name = $request->input('nombre');
            $usuario->apellidos = $request->input('apellidos');
            $usuario->telefono = $request->input('telefono');
            $usuario->email = $request->input('email');
            $usuario->restaurante_id = $request->input('restaurante_id');
            $usuario->save();

            $roles = $request->roles ? $request->roles : [];
            $usuario->syncRoles($roles);

            DB::commit();

            return response()->json([
                'mensaje' => 'El Usuario se actualizo con éxito',
                'usuario' => new UsuarioResource($usuario)
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
        $usuario = User::findOrFail((int) $id);
        $usuario->delete();

        return response()->json([
            'mensaje' => 'Eliminado con éxito',
        ], Response::HTTP_OK);
    }

    public function changePassword(ChangePasswordUserRequest $request)
    {

        $request->user()->update($request->only(['password']));

        return response()->json([
            'mensaje' => 'Password actualizado'
        ], Response::HTTP_OK);

    }

    public function newUser(UsuarioRequest $request)
    {
        try {
            DB::beginTransaction();

            $usuario = new User();

            $usuario->name = $request->input('nombre');
            $usuario->apellidos = $request->input('apellidos');
            $usuario->telefono = $request->input('telefono');
            $usuario->email = $request->input('email');
            $usuario->password = $request->input('password');
            $usuario->restaurante_id = null;
            $usuario->save();

            $roles = $request->roles ? $request->roles : [];
            $usuario->syncRoles($roles);

            DB::commit();

            return response()->json([
                'mensaje' => 'El Usuario se guardo exitosamente',
                'usuario' => new UsuarioResource($usuario)
            ], Response::HTTP_CREATED);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            response()->json([
                'mensaje' => 'Error al guardar, consulte al Administrador' . $e,
            ], Response::HTTP_FORBIDDEN);
        }
    }
}