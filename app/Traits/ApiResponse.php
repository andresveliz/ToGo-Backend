<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponse
{
    protected function errorResponse($message, $code)
    {   
        return response()->json(['error'=>$message, 'code'=>$code], $code);
    }
}