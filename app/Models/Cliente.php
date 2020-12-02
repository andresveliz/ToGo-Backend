<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function pedidos()
    {
        return $this->hasMany('App\Models\Pedido');
    }

    public function ubicaciones()
    {
        return $this->hasMany('App\Models\Ubicacion');
    }
}
