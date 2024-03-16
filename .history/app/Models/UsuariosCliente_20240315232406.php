<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosCliente extends Model
{
    use HasFactory;
    protected $table = 'usuariosClientes';
    protected $fillable = [
        'nombreCliente', 
        'usuarioApellidoPaterno',
         'usuarioApellidoMaterno', 'usuarioEmail', 'usuarioPassword', 'created_at', 'updated_at'];


    public function contactoDetalles()
    {
        return $this->hasMany(ContactoClientesDetalle::class, 'usuarios_clientes_id');
    }

    public function imagenDetalleClientes()
    {
        return $this->hasMany(ImagenDetalleCliente::class, 'usuarios_clientes_id');
    }

    public function comentarioDetalles()
    {
        return $this->hasMany(ComentarioDetalle::class, 'usuariosClientes_id');
    }

    public function acciones()
    {
        return $this->hasMany(AccionesUsuario::class, 'usuariosClientes_id');
    }
}
