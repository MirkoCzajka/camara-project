<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idEstadoProyecto')
                ->constrained('parametros')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('titulo', 180);
            $table->text('descripcion')->nullable();
            $table->string('propuestaPor', 150)->nullable();

            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('proyectos');
    }
};
