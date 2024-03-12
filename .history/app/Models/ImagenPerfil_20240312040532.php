<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenPerfil extends Model
{
    use HasFactory;
    protected $table = 'Imagenes_Perfil';
    protected $fillable = ['usuario_id', 'ruta'];
    public $timestamps = true;
}
