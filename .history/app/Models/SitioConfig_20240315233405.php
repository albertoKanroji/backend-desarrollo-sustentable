<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitioConfig extends Model
{
    use HasFactory;
    protected $table = 'sitioConfig';
    protected $guarded = ['id'];
    protected $fillable = ['nombre'];


    public function imagenes()
    {
        return $this->belongsToMany(Imagen::class, 'imagenesConfigSitio', 'sitioConfig_id', 'imagenes_id');
    }
}
