<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaPublicacion extends Model
{
    use HasFactory;
    protected $table = 'categoriasPublicaciones';
    protected $guarded = ['id'];
    protected $fillable = ['nombreCategoria', 'created_at', 'updated_at'];


    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class, 'categoriasPublicaciones_id');
    }
}
