<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiAuth\RegisterRequest;
use App\Utilities\ProxyRequest;
use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    protected $proxy;

    public function __construct(ProxyRequest $proxy)
    {
        $this->proxy = $proxy;
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $resp = $this->proxy->grantPasswordToken($user->email, $request->input('password'));

        return response([
            'access_token' => $resp['access_token'],
            'expires_in' => $resp['expires_in'],
            'message' => 'Tu cuenta ha sido creada.',
        ], 201);
    }
}
