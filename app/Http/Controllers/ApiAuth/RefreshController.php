<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use App\Utilities\ProxyRequest;
use Illuminate\Http\Request;

class RefreshController extends Controller
{
    protected $proxy;

    public function __construct(ProxyRequest $proxy)
    {
        $this->proxy = $proxy;
    }

    public function refreshToken()
    {
        $resp = $this->proxy->refreshAccessToken();

        return response([
            'access_token' => $resp['access_token'],
            'expires_in' => $resp['expires_in'],
            'message' => 'Token ha sido actualizado.',
        ], 200);
    }
}
