<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InitialVoteFlowSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // -------- Helpers ----------
            $upsertParametro = function (string $categoria, string $valor, ?string $descripcion = null) {
                DB::table('parametros')->updateOrInsert(
                    ['categoria' => $categoria, 'valor' => $valor],
                    ['descripcion' => $descripcion, 'updated_at' => now(), 'created_at' => now()]
                );
            };
            $idParam = function (string $categoria, string $valor): int {
                return (int) DB::table('parametros')
                    ->where('categoria', $categoria)
                    ->where('valor', $valor)
                    ->value('id');
            };

            // TipoVoto
            $upsertParametro('TipoVoto', 'Aprobado',   'Voto a favor');
            $upsertParametro('TipoVoto', 'Reprobado',  'Voto en contra');
            $upsertParametro('TipoVoto', 'Abstencion', 'Se abstiene');

            // EstadoSesion
            $upsertParametro('EstadoSesion', 'Planificada', 'Sesión planificada');
            $upsertParametro('EstadoSesion', 'EnCurso',     'Sesión en curso');
            $upsertParametro('EstadoSesion', 'Cerrada',     'Sesión cerrada');

            // EstadoAsistencia
            $upsertParametro('EstadoAsistencia', 'Presente', 'Diputado presente');
            $upsertParametro('EstadoAsistencia', 'Ausente',  'Diputado ausente');

            // EstadoRonda
            $upsertParametro('EstadoRonda', 'Abierta',   'Ronda abierta');
            $upsertParametro('EstadoRonda', 'Cerrada',   'Ronda cerrada');
            $upsertParametro('EstadoRonda', 'Cancelada', 'Ronda cancelada');

            // EstadoSolicitudAbstencion
            $upsertParametro('EstadoSolicitudAbstencion', 'Solicitada', 'Abstención solicitada');
            $upsertParametro('EstadoSolicitudAbstencion', 'Aprobada',   'Abstención aprobada');
            $upsertParametro('EstadoSolicitudAbstencion', 'Rechazada',  'Abstención rechazada');

            // EstadoProyecto
            $upsertParametro('EstadoProyecto', 'Pendiente',   'Pendiente de tratamiento');
            $upsertParametro('EstadoProyecto', 'A_tratarse',  'Agendado para tratarse');
            $upsertParametro('EstadoProyecto', 'Rechazado',   'Proyecto rechazado');
            $upsertParametro('EstadoProyecto', 'Aprobado',    'Proyecto aprobado');

            // -------- Diputado ----------
            $diputadoId = DB::table('diputados')->insertGetId([
                'usuario'    => 'dip1',
                'contrasena' => Hash::make('secret'),
                'nombre'     => 'Diputado Demo',
                'partido'    => 'Independiente',
                'distrito'   => 'Distrito Centro',
                'activo'     => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // -------- Sesión ----------
            $estadoSesionEnCursoId = $idParam('EstadoSesion', 'EnCurso');

            $sesionId = DB::table('sesiones')->insertGetId([
                'fechaInicio'           => Carbon::today()->toDateString(),
                'fechaFin'              => null,
                'idEstadoSesion'        => $estadoSesionEnCursoId,
                'idDiputadoPresidente'  => $diputadoId,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);

            // -------- Asistencia ----------
            $estadoAsistenciaPresenteId = $idParam('EstadoAsistencia', 'Presente');

            DB::table('asistencias')->updateOrInsert(
                ['idSesion' => $sesionId, 'idDiputado' => $diputadoId],
                [
                    'idEstadoAsistencia' => $estadoAsistenciaPresenteId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // -------- Proyecto ----------
            $estadoProyectoPendienteId = $idParam('EstadoProyecto', 'Pendiente');

            $proyectoId = DB::table('proyectos')->insertGetId([
                'idEstadoProyecto' => $estadoProyectoPendienteId,
                'titulo'           => 'Proyecto de ejemplo para votar',
                'descripcion'      => 'Proyecto inicial para pruebas de emisión de voto.',
                'propuestaPor'     => 'Comisión de Demo',
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            // -------- Proyecto en la sesión (orden 1) ----------
            $proyectoSesionId = DB::table('proyectos_sesion')->insertGetId([
                'orden'     => 1,
                'idProyecto'=> $proyectoId,
                'idSesion'  => $sesionId,
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);

            // -------- Ronda de votación ----------
            $estadoRondaAbiertaId = $idParam('EstadoRonda', 'Abierta');

            DB::table('rondas_votacion')->insert([
                'idProyectoSesion' => $proyectoSesionId,
                'horaInicio'       => Carbon::now(),
                'horaFin'          => null,
                'idEstadoRonda'    => $estadoRondaAbiertaId,
                'resultadoFinal'   => null,
                'porDesempate'     => false,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        });
    }
}
