<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicacionDetalle extends Model
{
    use HasFactory;
    protected $table = 'publicacionDetalle';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'publicaciones_id');
    }
}
