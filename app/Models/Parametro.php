<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;

    protected $table = 'parametros';
    protected $fillable = ['categoria', 'valor', 'descripcion'];

    public function scopeCategoria($q, string $cat){ return $q->where('categoria', $cat); }
    public static function idDe(string $cat, string $val): ?int
    { return static::where(compact('cat','val'))->value('id'); }
}
