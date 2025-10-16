<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoSesion extends Model
{
    use HasFactory;

    protected $table = 'proyectos_sesion';
    protected $fillable = ['orden','idProyecto','idSesion'];

    public function proyecto(){ return $this->belongsTo(Proyecto::class, 'idProyecto'); }
    public function sesion()  { return $this->belongsTo(Sesion::class, 'idSesion'); }
    public function rondas()  { return $this->hasMany(RondaVotacion::class, 'idProyectoSesion'); }
}
