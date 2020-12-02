<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo extends Model
{
    use SoftDeletes;

    protected $table = 'tipos';
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    protected $fillable = ['nombre'];

    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }
}
