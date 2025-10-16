<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudAbstencion extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_abstencion';
    protected $fillable = ['idDiputado','idRondaVotacion','idEstadoSolicitudAbstencion','motivo','fechaSolicitada','fechaDecision'];
    protected $casts = ['fechaSolicitada' => 'date', 'fechaDecision' => 'date'];

    public function diputado() { return $this->belongsTo(Diputado::class, 'idDiputado'); }
    public function ronda()    { return $this->belongsTo(RondaVotacion::class, 'idRondaVotacion'); }
    public function estado()   { return $this->belongsTo(Parametro::class, 'idEstadoSolicitudAbstencion'); }
}
