<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RondaVotacion extends Model
{
    use HasFactory;

    protected $table = 'rondas_votacion';
    protected $fillable = ['idProyectoSesion','horaInicio','horaFin','idEstadoRonda','resultadoFinal','porDesempate'];
    protected $casts = [
        'horaInicio' => 'datetime',
        'horaFin'    => 'datetime',
        'porDesempate' => 'bool',
    ];

    public function proyectoSesion(){ return $this->belongsTo(ProyectoSesion::class, 'idProyectoSesion'); }
    public function estado()        { return $this->belongsTo(Parametro::class, 'idEstadoRonda'); }
    public function votos()         { return $this->hasMany(Voto::class, 'idRondaVotacion'); }
    public function solicitudesAbstencion(){ return $this->hasMany(SolicitudAbstencion::class, 'idRondaVotacion'); }
}
