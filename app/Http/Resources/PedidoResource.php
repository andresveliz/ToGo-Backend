<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Carbon\Carbon;

class PedidoResource extends JsonResource
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
            'orden' => [

                'pedido_id' => $this->id,
                'fecha' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-yy'),
                'total' => $this->total,
                'ubicacion' => [
                    'latitude' => $this->ubicacion->ubicacion->getLat(),
                    'longitude' => $this->ubicacion->ubicacion->getLng()
                ],
                'direccion' => $this->ubicacion->direccion,
                'referencia' => $this->ubicacion->referencia,
            ],
            'cliente' => new ClienteResource($this->cliente),
            'detalle' => $this->productos,
            'entrega' => $this->entrega
        ];
    }
}
