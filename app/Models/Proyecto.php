<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';
    protected $fillable = ['idEstadoProyecto','titulo','descripcion','propuestaPor'];

    public function estado()  { return $this->belongsTo(Parametro::class, 'idEstadoProyecto'); }
    public function enSesiones(){ return $this->hasMany(ProyectoSesion::class, 'idProyecto'); }
}
