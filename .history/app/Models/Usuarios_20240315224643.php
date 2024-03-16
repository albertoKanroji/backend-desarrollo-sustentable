<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;
    protected $table = 'Usuarios';
    protected $fillable = ['nombre_usuario', 'correo_electronico', 'contrasena'];
    public $timestamps = true;

}
22:46:21	CREATE TABLE IF NOT EXISTS `bndgjgs93qlo82x5dv5f`.`tagPublicacionDetalle` (   `id` INT NULL AUTO_INCREMENT,   `created_at` VARCHAR(45) NULL,   `updated_at` VARCHAR(45) NULL,   `tags_id` INT NOT NULL,   `publicaciones_id` INT NOT NULL,   PRIMARY KEY (`id`),   INDEX `fk_tagPublicacionDetalle_tags1_idx` (`tags_id` ASC) VISIBLE,   INDEX `fk_tagPublicacionDetalle_publicaciones1_idx` (`publicaciones_id` ASC) VISIBLE,   CONSTRAINT `fk_tagPublicacionDetalle_tags1`     FOREIGN KEY (`tags_id`)     REFERENCES `bndgjgs93qlo82x5dv5f`.`tags` (`id`)     ON DELETE NO ACTION     ON UPDATE NO ACTION,   CONSTRAINT `fk_tagPublicacionDetalle_publicaciones1`     FOREIGN KEY (`publicaciones_id`)     REFERENCES `bndgjgs93qlo82x5dv5f`.`publicaciones` (`id`)     ON DELETE NO ACTION     ON UPDATE NO ACTION) ENGINE = InnoDB	Error Code: 1171. All parts of a PRIMARY KEY must be NOT NULL; if you need NULL in a key, use UNIQUE instead	0.125 sec

