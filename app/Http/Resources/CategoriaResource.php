<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CategoriaResource extends JsonResource
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
            'id'           => $this->id,
            'nombre'       => $this->nombre,
            'imagen'       => $this->image_url,
            'created_at'   => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-yy'),
            'updated_at'   => Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('d-m-yy'),
            'restaurantes' => RestauranteResource::collection($this->restaurantes)
        ];
    }
}
