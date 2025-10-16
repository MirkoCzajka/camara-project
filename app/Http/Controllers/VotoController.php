<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Sesion;
use App\Models\RondaVotacion;
use App\Models\Parametro;
use App\Models\Diputado;
use App\Models\Voto;

class VotoController extends Controller
{
    // Recibiría parámetro de proyecto en curso
    var $proyectoEnCursoId = 1;

    public function enSesion()
    {
        // Recibiría parámetros de la sesión y votación
        $sesionId = 1;
        $proyectoId = 1;
        $rondaVotacionId = 1;

        $sesion = Sesion::find($sesionId);
        $proyecto = Proyecto::find($this->proyectoEnCursoId);
        $votacion = RondaVotacion::find($rondaVotacionId);

        $estadoSesion = Parametro::where('categoria', 'EstadoSesion')
            ->where('id', $sesion->idEstadoSesion)
            ->value('descripcion');
        $estadoVotacion = Parametro::where('categoria', 'EstadoRonda')
            ->where('id', $votacion->idEstadoRonda)
            ->value('descripcion');

        return view('enSesionDiputado', compact('proyecto', 'estadoSesion', 'estadoVotacion'));
    }

    public function emitirVotoForm()
    {
        $proyecto = Proyecto::find($this->proyectoEnCursoId);

        return view('emitirVoto', compact('proyecto'));
    }

    public function emitirVoto(Request $request)
    {
        $data = $request->validate([
            'opcion' => ['required', 'in:Aprobado,Reprobado'],
        ]);

        $tipoVotoId = Parametro::where('categoria', 'TipoVoto')
            ->where('valor', $data['opcion'])
            ->value('id');

        $diputadoId = Diputado::where('usuario','dip1')->value('id');

        $rondaId = RondaVotacion::orderByDesc('id')->value('id');

        if (!$tipoVotoId || !$diputadoId || !$rondaId) {
            return back()->with('status', 'No se pudo determinar la ronda, diputado o tipo de voto.');
        }

        $existe = Voto::where('idDiputado', $diputadoId)
            ->where('idRondaVotacion', $rondaId)
            ->exists();

        if ($existe) {
            return back()->with('status', 'Ya has emitido tu voto para esta ronda.');
        }

        Voto::create([
            'idDiputado'      => $diputadoId,
            'idRondaVotacion' => $rondaId,
            'idTipoVoto'      => $tipoVotoId,
            'fechaVoto'       => now(),
            'esVotoDesempate' => false,
        ]);

        return redirect()
            ->route('voto.esperar')
            ->with('status', 'Voto registrado correctamente.');
    }

    public function esperarVotacion()
    {
        // En una app real: $diputadoId = auth()->user()->diputado_id;
        $diputadoId = Diputado::where('usuario','dip1')->value('id');

        $voto = Voto::with([
            'tipoVoto', 
            'rondaVotacion.proyectoSesion.proyecto'
        ])->where('idDiputado', $diputadoId)
        ->latest('id')
        ->first();

        $opcion   = $voto?->tipoVoto?->valor ?? 'N/D';
        $proyecto = $voto?->rondaVotacion?->proyectoSesion?->proyecto?->titulo ?? 'Proyecto actual';

        return view('esperarVotacion', compact('opcion','proyecto'));
    }
}
