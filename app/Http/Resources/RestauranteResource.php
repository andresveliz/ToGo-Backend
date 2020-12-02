<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Carbon\Carbon;

class RestauranteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'nombre'      => $this->nombre,
            'direccion'   => $this->direccion,
            'telefono'    => $this->telefono,
            'email'       => $this->email,
            'logo'        => $this->image_url,
            'descripcion' => $this->descripcion,
            'estado'      => $this->estado,  
            'ubicacion' => [
                'latitude'  => $this->ubicacion->getLat(),
                'longitude' => $this->ubicacion->getLng()
            ],
            'categorias' => $this->categorias,
            'productos' => $this->productos
        ];
    }
}
