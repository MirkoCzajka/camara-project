<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VotoController;

Route::get('/sesion', [VotoController::class, 'enSesion'])
    ->name('diputado.sesion');

Route::get('/emitir-voto', [VotoController::class, 'emitirVotoForm'])
    ->name('voto.emitir.form');

Route::post('/emitir-voto', [VotoController::class, 'emitirVoto'])
    ->name('voto.emitir');

Route::get('/espera-votacion', [VotoController::class, 'esperarVotacion'])
    ->name('voto.esperar');
