<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
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
            'producto_id' => $this->id,
            'nombre' => $this->nombre,
            'imagen' => $this->image_url,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'restaurante_id' => $this->restaurante_id,
            // 'cantidad' => $this->pivot->cantidad,
            // 'sub_total' => $this->pivot->sub_total,
            'tipo' => $this->tipo,
        ];
    }
}
