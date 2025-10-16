<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sesiones', function (Blueprint $table) {
            $table->id();
            $table->date('fechaInicio')->nullable();
            $table->date('fechaFin')->nullable();

            $table->foreignId('idEstadoSesion')
                ->constrained('parametros')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('idDiputadoPresidente')
                ->constrained('diputados')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('sesiones');
    }
};
