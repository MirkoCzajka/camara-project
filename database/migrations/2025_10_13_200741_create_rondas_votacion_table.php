<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rondas_votacion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idProyectoSesion')
                ->constrained('proyectos_sesion')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // En el diagrama dice "horaInicio/horaFin (date)":
            // Uso datetime para mayor precisión.
            $table->dateTime('horaInicio')->nullable();
            $table->dateTime('horaFin')->nullable();

            $table->foreignId('idEstadoRonda')
                ->constrained('parametros')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('resultadoFinal', 100)->nullable();
            $table->boolean('porDesempate')->default(false);

            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('rondas_votacion');
    }
};
