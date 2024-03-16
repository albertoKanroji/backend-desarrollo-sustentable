<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenDetalleCliente extends Model
{
    use HasFactory;
    protected $table = 'imagenDetalleClientes';
    protected $guarded = ['id'];
    protected $fillable = ['imagenes_id', 'usuarios_clientes_id'];


    public function imagen()
    {
        return $this->belongsTo(Imagen::class, 'imagenes_id');
    }

    public function cliente()
    {
        return $this->belongsTo(UsuariosCliente::class, 'usuarios_clientes_id');
    }
}
