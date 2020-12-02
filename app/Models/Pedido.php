<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

    protected $table = 'pedidos';
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    protected $fillable = ['fecha', 'ubicacion_id', 'cliente_id', 'restaurante_id'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id');
    }

    public function ubicacion()
    {
        return $this->belongsTo('App\Models\Ubicacion', 'ubicacion_id');
    }

    public function restaurante()
    {
        return $this->belongsTo('App\Models\Restaurante', 'restaurante_id');
    }

    public function entrega()
    {
        return $this->hasOne('App\Models\Entrega');
    }

    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto')->withPivot(['cantidad', 'sub_total']);
    }

    public function estados()
    {
        return $this->hasMany('App\Models\Estado');
    }
}
