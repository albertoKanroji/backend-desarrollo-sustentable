<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesConfigSitio extends Model
{
    use HasFactory;
    protected $table = 'imagenesConfigSitio';
    protected $guarded = ['id'];
    protected $fillable = ['created_at', 'updated_at', 'sitioConfig_id', 'imagenes_id'];


    public function sitioConfig()
    {
        return $this->belongsTo(SitioConfig::class, 'sitioConfig_id');
    }

    public function imagen()
    {
        return $this->belongsTo(Imagen::class, 'imagenes_id');
    }
}
