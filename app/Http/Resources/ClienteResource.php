<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
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
          'cliente_id' => $this->id,
          'nombre' => $this->user->name,
          'apellidos' => $this->user->apellidos,
          'telefono' => $this->user->telefono,
          'ci' => $this->ci,
          'nit' => $this->nit
        ];
    }
}
