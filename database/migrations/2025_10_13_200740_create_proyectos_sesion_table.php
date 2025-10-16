<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('proyectos_sesion', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('orden')->default(1);

            $table->foreignId('idProyecto')
                ->constrained('proyectos')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('idSesion')
                ->constrained('sesiones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();

            $table->unique(['idSesion', 'idProyecto'], 'uq_proy_sesion_unico');
        });
    }
    public function down(): void {
        Schema::dropIfExists('proyectos_sesion');
    }
};
