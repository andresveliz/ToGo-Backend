<?php

namespace App\Utilities;

use Illuminate\Http\Request;

class ProxyRequest
{
    public function grantPasswordToken(string $email, string $password)
    {
        $params = [
            'grant_type' => config('services.passport.grant_type'),
            'username' => $email,
            'password' => $password,
        ];

        return $this->makePostRequest($params);
    }

    public function refreshAccessToken()
    {
        $refreshToken = request()->cookie('refresh_token');

        abort_unless($refreshToken, 403, 'Su token de actualización ha caducado.');

        $params = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ];

        return $this->makePostRequest($params);
    }

    protected function makePostRequest(array $params)
    {
        $params = array_merge([
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'scope' => '*',
        ], $params);

        $proxy = Request::create(config('services.passport.login_endpoint'), 'POST', $params);

        $resp = json_decode(app()->handle($proxy)->getContent(), true);
        $this->setHttpOnlyCookie($resp['refresh_token']);

        return $resp;
    }

    protected function setHttpOnlyCookie(string $refreshToken)
    {
        cookie()->queue(
            'refresh_token',
            $refreshToken,
            14400, // 10 days
            null,
            null,
            false,
            true // httponly
        );
    }
}
