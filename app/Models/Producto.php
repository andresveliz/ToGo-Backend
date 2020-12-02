<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $table = 'productos';
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'imagen', 'descripcion', 'precio', 'restautante_id', 'tipo_id'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(){
        return url('storage/productos/'.$this->imagen);
    }

    public function restaurante()
    {
        return $this->belongsTo('App\Models\Restaurante', 'restaurante_id');
    }

    public function tipo()
    {
        return $this->belongsTo('App\Models\Tipo', 'tipo_id');
    }

    public function pedidos()
    {
        return $this->belongsToMany('App\Models\Pedido')->withPivot(['cantidad', 'sub_total']);
    }
}
