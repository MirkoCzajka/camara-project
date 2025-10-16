<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diputado extends Model
{
    use HasFactory;

    protected $table = 'diputados';
    protected $fillable = ['usuario','contrasena','nombre','partido','distrito','activo'];
    protected $casts = ['activo' => 'bool'];

    public function asistencias() { return $this->hasMany(Asistencia::class, 'idDiputado'); }
    public function votos()       { return $this->hasMany(Voto::class, 'idDiputado'); }
    public function sesionesPresididas() { return $this->hasMany(Sesion::class, 'idDiputadoPresidente'); }
}
