<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - Banco</title>

    <!-- Tailwind CSS Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand font-bold" href="{{ route('home') }}">Banco</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @if (auth()->check())

                        <li class="nav-item active">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Inicio<span
                                    class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('credito.index') }}">Créditos Aprobados</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('solicitacredito.index') }}">Solicitud de Crédito</a>
                        </li>
                        @if (auth()->check() && (auth()->user()->rol == 'gerente' || auth()->user()->rol == 'admin'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index') }}">Usuarios</a>
                            </li>
                        @endif
                    @endif


                </ul>

                <!-- checkea si estoy logeado -->
                @if (auth()->check())
                    <p class="text-xl">Bienvenido@ <b>{{ auth()->user()->name }}</b></p>
                    <span class="mx-2"></span>
                    <a href="{{ route('login.destroy') }}" class="btn btn-danger">Cerrar sesión</a>
                @else
                    <a href="{{ route('login.index') }}" class="btn btn-primary">Iniciar sesión</a>
                    <span class="mx-2"></span>
                    <a href="{{ route('register.index') }}" class="btn btn-success">Regístrate</a>
                @endif


            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
