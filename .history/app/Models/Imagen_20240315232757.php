<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    protected $table = 'imagenes';
    protected $guarded = ['id'];
    protected $fillable = ['nombreImagen', 'rutaImagen', 'created_at', 'updated_at'];


    public function clientes()
    {
        return $this->belongsToMany(UsuariosCliente::class, 'imagenDetalleClientes', 'imagenes_id', 'usuarios_clientes_id');
    }

    public function publicaciones()
    {
        return $this->belongsToMany(Publicacion::class, 'imagenPublicacionesDetalle', 'imagenes_id', 'publicaciones_id');
    }

    public function sitioConfig()
    {
        return $this->belongsToMany(SitioConfig::class, 'imagenesConfigSitio', 'imagenes_id', 'sitioConfig_id');
    }
}
