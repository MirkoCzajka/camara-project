<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idSesion')
                ->constrained('sesiones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('idDiputado')
                ->constrained('diputados')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('idEstadoAsistencia')
                ->constrained('parametros')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();

            $table->unique(['idSesion', 'idDiputado'], 'uq_asistencia_sesion_diputado');
        });
    }
    public function down(): void {
        Schema::dropIfExists('asistencias');
    }
};
