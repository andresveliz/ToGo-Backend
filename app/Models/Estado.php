<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use SoftDeletes;

    protected $table = 'estados';
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    protected $fillable = ['estado', 'pedido_id'];

    public function pedido()
    {
        return $this->belongsTo('App\Models\Pedido', 'pedido_id');
    }
}
