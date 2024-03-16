<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;
    protected $table = 'publicaciones';
    protected $guarded = ['id'];
    protected $fillable = ['titulo', 'subTitulo', 'descripcion', 'created_at', 'updated_at', 'categoriasPublicaciones_id'];


    public function categoria()
    {
        return $this->belongsTo(CategoriaPublicacion::class, 'categoriasPublicaciones_id');
    }

    public function imagenes()
    {
        return $this->belongsToMany(Imagen::class, 'imagenPublicacionesDetalle', 'publicaciones_id', 'imagenes_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'publicacionDetalle', 'publicaciones_id', 'users_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tagPublicacionDetalle', 'publicaciones_id', 'tags_id');
    }

    public function comentarios()
    {
        return $this->hasMany(ComentarioDetalle::class, 'publicacion_id');
    }
}
