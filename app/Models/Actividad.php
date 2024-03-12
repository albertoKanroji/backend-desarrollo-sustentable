<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    protected $table = 'Actividad';
    protected $fillable = ['usuario_id', 'tipo_actividad', 'detalle'];
    public $timestamps = true;
}
