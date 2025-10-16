<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    use HasFactory;

    protected $table = 'votos';
    public $timestamps = true;
    protected $fillable = [
        'idDiputado', 'idRondaVotacion', 'idTipoVoto', 'fechaVoto', 'esVotoDesempate'
    ];
    protected $casts = [
        'fechaVoto' => 'datetime',
        'esVotoDesempate' => 'bool',
    ];

    public function diputado()     { return $this->belongsTo(Diputado::class, 'idDiputado'); }
    public function rondaVotacion(){ return $this->belongsTo(RondaVotacion::class, 'idRondaVotacion'); }
    public function tipoVoto()     { return $this->belongsTo(Parametro::class, 'idTipoVoto'); }
}
