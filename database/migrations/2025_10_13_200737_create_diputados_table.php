<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('diputados', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', 100)->unique();
            $table->string('contrasena', 255);
            $table->string('nombre', 150);
            $table->string('partido', 120)->nullable();
            $table->string('distrito', 120)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('diputados');
    }
};
