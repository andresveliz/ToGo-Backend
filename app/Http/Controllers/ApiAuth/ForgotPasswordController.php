<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use App\Utilities\ProxyRequest;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    protected $proxy;

    public function __construct(ProxyRequest $proxy)
    {
        $this->proxy = $proxy;
    }
}
