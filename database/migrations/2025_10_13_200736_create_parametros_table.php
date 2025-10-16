<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('parametros', function (Blueprint $table) {
            $table->id();
            $table->string('categoria', 100);
            $table->string('valor', 100);
            $table->string('descripcion', 255)->nullable();

            $table->unique(['categoria', 'valor'], 'uq_param_categoria_valor');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('parametros');
    }
};
