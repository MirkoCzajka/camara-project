@extends('layouts.app')

@section('title', 'Emitir voto')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">Emitir voto</h1>
    <p class="text-muted mb-4">Seleccione su voto para el proyecto {{ $proyecto?->titulo ?? 'actual' }}.</p>

    <div class="card mb-4">
        <div class="card-body d-flex flex-column align-items-center text-center">

            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <form method="POST" action="{{ route('voto.emitir') }}" class="d-inline-block">
                    @csrf
                    <input type="hidden" name="opcion" value="Aprobado">
                    <button class="btn btn-success btn-lg" type="submit">APROBAR</button>
                </form>

                <form method="POST" action="{{ route('voto.emitir') }}" class="d-inline-block">
                    @csrf
                    <input type="hidden" name="opcion" value="Reprobado">
                    <button class="btn btn-danger btn-lg" type="submit">REPROBAR</button>
                </form>
            </div>

            <a href="{{ route('diputado.sesion') }}" class="btn btn-secondary btn-sm mt-4 px-4">
            REGRESAR
            </a>

            @error('opcion')
            <div class="text-danger mt-3">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <small class="text-muted">
        * Esta pantalla representa la funcionalidad del caso de uso “Emitir Voto”.
    </small>
</div>
@endsection
