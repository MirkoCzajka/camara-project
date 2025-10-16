@extends('layouts.app')

@section('title', 'Sesión en curso — Diputado')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">{{ $estadoSesion ?? 'Sesion' }}</h1>
    <p class="text-muted mb-4">Cámara de Representantes de la Provincia de Misiones</p>

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div><strong>Proyecto:</strong> <span>{{ $proyecto?->titulo ?? 'N/D' }}</span></div>
                    <div><strong>Estado de la Votación:</strong> <span id="estadoSesion">{{ $estadoVotacion ?? 'Sin estado' }}</span></div>
                </div>
                <span class="badge bg-success">{{ $estadoVotacion ?? 'Sin estado' }}</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8 col-lg-6 mx-auto">
        <div class="d-grid gap-3">

            <a href="{{ route('voto.emitir.form') }}" class="btn btn-primary btn-lg w-100">
                EMITIR VOTO
            </a>

            <span class="d-grid" tabindex="0" data-bs-toggle="tooltip" data-bs-title="No disponible durante la votación">
            <button class="btn btn-outline-secondary btn-lg w-100" type="button" disabled style="pointer-events:none;">
                SOLICITAR ABSTENCIÓN
            </button>
            </span>

            <span class="d-grid" tabindex="0" data-bs-toggle="tooltip" data-bs-title="No disponible durante la votación">
            <button class="btn btn-outline-secondary btn-lg w-100" type="button" disabled style="pointer-events:none;">
                VER PROYECTO
            </button>
            </span>

            <span class="d-grid" tabindex="0" data-bs-toggle="tooltip" data-bs-title="No disponible durante la votación">
            <button class="btn btn-outline-secondary btn-lg w-100" type="button" disabled style="pointer-events:none;">
                VER RESULTADOS DE VOTACIONES PREVIAS
            </button>
            </span>

        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
            new bootstrap.Tooltip(el, { container: 'body' });
        });
    });
</script>
@endpush

@endsection
