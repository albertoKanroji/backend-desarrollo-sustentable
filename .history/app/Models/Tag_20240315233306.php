<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $guarded = ['id'];
    protected $fillable = ['nombreTag', 'created_at', 'updated_at'];


    public function publicaciones()
    {
        return $this->belongsToMany(Publicacion::class, 'tagPublicacionDetalle', 'tags_id', 'publicaciones_id');
    }
}
