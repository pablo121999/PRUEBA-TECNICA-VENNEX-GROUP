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
        <a class="navbar-brand font-bold" href="#">Banco</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.index') }}">Home <span
                            class="sr-only">(current)</span></a>
                </li>

                @if (auth()->check())
                        <li class="nav-item">
                            <a class="nav-link" href="#">Créditos Aprobados</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('solicitacredito.index') }}">Solicitud de Crédito</a>
                        </li>
                @endif

            </ul>
            <!-- checkea si estoy logeado -->
            @if (auth()->check())
                <p class="text-xl">Bienvenid@ <b>{{ auth()->user()->name }}</b></p>
                <span class="mx-2"></span>
                <a href="{{ route('login.destroy') }}" class="btn btn-danger">Cerrar sesió</a>
            @else
                <a href="{{ route('login.index') }}" class="btn btn-primary">Login</a>
                <span class="mx-2"></span>
                <a href="{{ route('register.index') }}" class="btn btn-primary">Regístrate</a>
            @endif

        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
