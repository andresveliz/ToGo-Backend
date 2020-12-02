<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TipoResource extends JsonResource
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
            'tipo_id' => $this->id,
            'nombre' => $this->nombre,
            'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-yy'),
            'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('d-m-yy'),
            'productos' => ProductoResource::collection($this->productos)
        ];
    }
}
