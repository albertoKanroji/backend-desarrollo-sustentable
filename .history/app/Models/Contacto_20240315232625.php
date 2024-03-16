<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;
    protected $table = 'contacto';
    protected $fillable = ['comentario', 'created_at', 'updated_at'];

    public function detalles()
    {
        return $this->hasMany(ContactoClientesDetalle::class, 'contacto_id');
    }
}
