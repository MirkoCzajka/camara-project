<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('solicitudes_abstencion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idDiputado')
                ->constrained('diputados')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('idRondaVotacion')
                ->constrained('rondas_votacion')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('idEstadoSolicitudAbstencion')
                ->constrained('parametros')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('motivo', 255)->nullable();
            $table->date('fechaSolicitada')->nullable();
            $table->date('fechaDecision')->nullable();

            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('solicitudes_abstencion');
    }
};
