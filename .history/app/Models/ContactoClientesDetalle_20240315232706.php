<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoClientesDetalle extends Model
{
    use HasFactory;
    protected $table = 'contactoClientesDetalle';
    protected $guarded = ['id'];

    public function contacto()
    {
        return $this->belongsTo(Contacto::class, 'contacto_id');
    }

    public function cliente()
    {
        return $this->belongsTo(UsuariosCliente::class, 'usuarios_clientes_id');
    }
}
