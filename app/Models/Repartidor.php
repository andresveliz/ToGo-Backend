<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Repartidor extends Model
{
    use SpatialTrait, SoftDeletes;

    protected $table = 'repartidores';
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    protected $fillable = ['estado', 'ruat', 'nit', 'user_id'];

    protected $spatialFields = ['ubicacion'];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function entregas()
    {
        return $this->hasMany('App\Models\Entrega');
    }
}
