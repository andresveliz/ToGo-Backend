<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RepartidorResource extends JsonResource
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
            'nombre' => $this->user->name,
            'apellidos' => $this->user->apellidos,
            'telefono' => $this->user->telefono,
            'email' => $this->user->email,
            'ruat' => $this->ruat,
            'nit' => $this->nit,
            'user_id' => $this->user_id,
            // 'ubicacion' => [
            //     'latitude'  => $this->ubicacion->getLat() == null ? null : $this->ubicacion->getLat(),
            //     'longitude' => $this->ubicacion->getLng() == null ? null : $this->ubicacion->getLng()
            // ],
            'estado' => $this->estado == true ? 'Libre' : 'En ruta',
            'entregas' => EntregaResource::collection($this->entregas)
        ];
    }
}
