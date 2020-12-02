<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'logo'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(){
        return url('storage/categorias/'.$this->logo);
    }

    public function restaurantes()
    {
        return $this->belongsToMany('App\Models\Restaurante');
    }
}
