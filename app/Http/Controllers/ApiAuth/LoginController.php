<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiAuth\LoginRequest;
use App\Http\Resources\UsuarioResource;
use Illuminate\Support\Facades\Hash;
use App\Utilities\ProxyRequest;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\User;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    use ApiResponse;

    protected $proxy;

    public function __construct(ProxyRequest $proxy)
    {
        $this->proxy = $proxy;
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->input('email'))->first();
            abort_unless($user, 404, 'Los datos ingresados no coinciden con nuestros registros.');
            abort_unless(Hash::check($request->input('password'), $user->password), 403, 'Los datos ingresados no coinciden con nuestros registros.');
            $resp = $this->proxy->grantPasswordToken($request->input('email'), $request->input('password'));
            return response([
                'access_token' => $resp['access_token'],
                'expires_in' => $resp['expires_in'],
                'message' => 'Has iniciado sesión Correctamente.'
            ], 200);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 400);
        }
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        # Eliminando la cookie httponly
        cookie()->queue(cookie()->forget('refresh_token'));
        return response(['message' => 'Ha sido desconectado exitosamente.'], 200);
    }

    public function currentUser(){
        $user = new UsuarioResource(auth()->user());
        return response()->json($user, Response::HTTP_OK);
    }
}
