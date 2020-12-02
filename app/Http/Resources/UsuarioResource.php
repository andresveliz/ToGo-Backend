<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
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
            'id' => $this->id,
            'nombre' => $this->name,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'rol' => RolResource::collection($this->roles),
            'repartidor' => $this->repartidor,
            'cliente' => $this->cliente,
            'restaurante' => $this->restaurante,
        ];
    }
}
