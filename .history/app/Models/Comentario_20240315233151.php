<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';
    protected $guarded = ['id'];
    protected $fillable = ['comentario', 'created_at', 'updated_at'];


    public function detalles()
    {
        return $this->hasMany(ComentarioDetalle::class, 'comentarios_id');
    }
}
