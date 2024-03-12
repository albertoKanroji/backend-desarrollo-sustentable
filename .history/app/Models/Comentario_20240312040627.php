<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'Comentarios';
    protected $fillable = ['contenido', 'usuario_id', 'post_id'];
    public $timestamps = true;
}
