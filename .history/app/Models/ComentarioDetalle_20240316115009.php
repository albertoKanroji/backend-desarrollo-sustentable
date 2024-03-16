<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioDetalle extends Model
{
    use HasFactory;
    protected $table = 'comentarioDetalle';
    protected $guarded = ['id'];
    protected $fillable = ['created_at', 'updated_at', 'comentarios_id', 'usuariosClientes_id','publicacion_id'];

    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'publicaciones_id');
    }
    public function comentario()
    {
        return $this->belongsTo(Comentario::class, 'comentarios_id');
    }

    public function cliente()
    {
        return $this->belongsTo(UsuariosCliente::class, 'usuariosClientes_id');
    }
}
