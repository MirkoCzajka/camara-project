<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;

    protected $table = 'sesiones';
    protected $fillable = ['fechaInicio','fechaFin','idEstadoSesion','idDiputadoPresidente'];
    protected $casts = ['fechaInicio' => 'date', 'fechaFin' => 'date'];

    public function estado()   { return $this->belongsTo(Parametro::class, 'idEstadoSesion'); }
    public function presidente(){ return $this->belongsTo(Diputado::class, 'idDiputadoPresidente'); }
    public function asistencias(){ return $this->hasMany(Asistencia::class, 'idSesion'); }
    public function proyectosSesion(){ return $this->hasMany(ProyectoSesion::class, 'idSesion'); }
}
