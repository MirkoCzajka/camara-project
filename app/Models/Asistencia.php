<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';
    protected $fillable = ['idSesion','idDiputado','idEstadoAsistencia'];

    public function sesion()    { return $this->belongsTo(Sesion::class, 'idSesion'); }
    public function diputado()  { return $this->belongsTo(Diputado::class, 'idDiputado'); }
    public function estado()    { return $this->belongsTo(Parametro::class, 'idEstadoAsistencia'); }
}
