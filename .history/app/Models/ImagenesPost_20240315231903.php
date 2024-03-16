<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesPost extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }
}
