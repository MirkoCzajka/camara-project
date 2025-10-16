@extends('layouts.app')

@section('title', 'Voto registrado')

@section('content')
<div class="container py-5">
    <div class="col-12 col-md-8 col-lg-6 mx-auto">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="mb-3">Tu voto fue registrado</h2>

                <p class="mb-1">
                Proyecto: <strong>{{ $proyecto }}</strong>
                </p>
                <p class="mb-4">
                Tu voto: 
                @if($opcion === 'Aprobado')
                    <span class="badge bg-success">{{ $opcion }}</span>
                @elseif($opcion === 'Reprobado')
                    <span class="badge bg-danger">{{ $opcion }}</span>
                @else
                    <span class="badge bg-secondary">{{ $opcion }}</span>
                @endif
                </p>

                <div class="my-4">
                    <div class="spinner-border" role="status" aria-hidden="true"></div>
                    <div class="mt-3 text-muted">
                        A la espera de que finalice la ronda de votación
                        <br>
                        (o que el presidente cierre la sesión).
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
