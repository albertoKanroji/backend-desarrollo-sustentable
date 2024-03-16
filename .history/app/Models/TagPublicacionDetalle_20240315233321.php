<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagPublicacionDetalle extends Model
{
    use HasFactory;
    protected $table = 'tagPublicacionDetalle';
    protected $guarded = ['id'];

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tags_id');
    }

    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'publicaciones_id');
    }
}
