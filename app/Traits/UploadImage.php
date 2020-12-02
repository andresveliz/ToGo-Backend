<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

trait UploadImage
{
    protected function subirImagen($archivo, $imagen_actual = false, $folder, $ancho = 240, $alto = 240)
    {
        if($imagen_actual){
            Storage::disk('public')->delete($folder. '/' .$imagen_actual);
        }
        $extension = $archivo->getClientOriginalExtension();
        $imagen_name = Str::random(10).'.'. $extension;
        $imagen = Image::make($archivo)->encode($extension, 50);
        $imagen->resize($ancho, $alto, function($constraint) {
            $constraint->upsize();
        });

        Storage::disk('public')->put($folder. '/' . $imagen_name, $imagen->stream());
        return $imagen_name;

    }


}

