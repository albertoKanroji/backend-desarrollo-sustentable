<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPost extends Model
{
    use HasFactory;
    protected $table = 'Usuarios_Posts';
    protected $fillable = ['usuario_id', 'post_id'];
    public $timestamps = true;
}
