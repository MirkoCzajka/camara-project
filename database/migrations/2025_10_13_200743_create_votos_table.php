<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('votos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idDiputado')
                ->constrained('diputados')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('idRondaVotacion')
                ->constrained('rondas_votacion')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('idTipoVoto')
                ->constrained('parametros')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->dateTime('fechaVoto')->nullable();
            $table->boolean('esVotoDesempate')->default(false);

            $table->timestamps();

            $table->unique(['idRondaVotacion', 'idDiputado'], 'uq_voto_unico_ronda_dip');
        });
    }
    public function down(): void {
        Schema::dropIfExists('votos');
    }
};
