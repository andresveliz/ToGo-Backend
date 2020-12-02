<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrega extends Model
{
    use SoftDeletes;

    protected $table = 'entregas';
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    protected $fillable = ['observaciones', 'estado', 'repartidor_id', 'pedido_id'];

    public function pedido()
    {
        return $this->belongsTo('App\Models\Pedido', 'pedido_id');
    }

    public function repartidor()
    {
        return $this->belongsTo('App\Models\Repartidor', 'repartidor_id');
    }
}
