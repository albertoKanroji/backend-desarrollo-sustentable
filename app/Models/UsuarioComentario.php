<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioComentario extends Model
{
    use HasFactory;
    protected $table = 'Usuarios_Comentarios';
    protected $fillable = ['usuario_id', 'comentario_id'];
    public $timestamps = true;
}
