<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccionesUsuariosClientes extends Model
{
    use HasFactory;
    protected $table = 'accionesUsuaruisClientes';
    protected $guarded = ['id'];

    public function cliente()
    {
        return $this->belongsTo(UsuariosCliente::class, 'usuariosClientes_id');
    }
}
