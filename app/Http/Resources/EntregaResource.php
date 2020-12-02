<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntregaResource extends JsonResource
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
            'estado_entrega' => $this->estado,
            'observaciones' => $this->observaciones,
            'pedido' => new PedidoResource($this->pedido)
        ];
    }
}
