<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenPublicacionesDetalle extends Model
{
    use HasFactory;
    protected $table = 'imagenPublicacionesDetalle';
    protected $guarded = ['id'];
    protected $fillable = ['imagenes_id', 'publicaciones_id', 'created_at', 'updated_at'];


    public function imagen()
    {
        return $this->belongsTo(Imagen::class, 'imagenes_id');
    }

    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'publicaciones_id');
    }
}
