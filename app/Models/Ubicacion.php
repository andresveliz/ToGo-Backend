<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Ubicacion extends Model
{
    use SpatialTrait, SoftDeletes;

    protected $table = 'ubicaciones';
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    protected $fillable = ['referencia', 'cliente_id'];

    protected $spatialFields = ['ubicacion'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id');
    }

    public function pedido()
    {
        return $this->hasOne('App\Models\Pedido');
    }
}
