<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Restaurante extends Model
{
    use SpatialTrait, SoftDeletes;

    protected $table = 'restaurantes';
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'direccion', 'telefono', 'email', 'logo', 'descripcion', 'tiempo_entrega'];

    protected $spatialFields = ['ubicacion'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(){
        return url('storage/restaurantes/'.$this->logo);
    }

    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function pedidos()
    {
        return $this->hasMany('App\Models\Pedido');
    }

    public function categorias()
    {
        return $this->belongsToMany('App\Models\Categoria');
    }

}
