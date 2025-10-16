<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>@yield('title','Cámara')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap 5 via CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-light bg-light mb-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('diputado.sesion') }}">Cámara de Representantes de la Provincia de Misiones.</a>
        </div>
    </nav>

    @if(session('status'))
    <div class="container">
        <div class="alert alert-success">{{ session('status') }}</div>
    </div>
    @endif

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
