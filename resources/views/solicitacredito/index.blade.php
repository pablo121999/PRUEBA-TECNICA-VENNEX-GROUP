@extends('layouts.app')

@section('title', 'index')

@section('content')

    <br>
    @if (auth()->check() && (auth()->user()->rol == 'cliente' || auth()->user()->rol == null))
        <div class="container  col-md-11 d-flex justify-content-end">
            <a href="{{ route('solicitacredito.create') }}" class="btn btn-primary">Solicitar Credito</a>
        </div>
    @endif

    <br>
    <h1 style="text-align: center; font-weight: bold;">Solicitudes de credito</h1>
    <br>

    <div class="container">
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Valor del crédito</th>
                    <th scope="col">Cuotas</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha de solicitud</th>
                    <th scope="col">tipo de crédito</th>
                    <th scope="col">Observaciones del asesor</th>
                    <th scope="col">acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($solicitudcredito as $so)
                    <tr>
                        <th scope="row">{{ $so->id }}</th>


                        @foreach ($user as $u)
                            @if ($so->cliente_id == $u->id)
                                <td>{{ $u->name }}</td>
                                @php
                                    $foundMatch = true;
                                    break; // Termina el bucle una vez que se ha encontrado una coincidencia
                                @endphp
                            @endif
                        @endforeach

                        <td>${{ number_format($so->valor_credito, 0, ',', '.') }}</td>
                        <td>{{ $so->cuotas }}</td>
                        <td>{{ $so->descripcion }}</td>

                        @if ($so->estado == 'A')
                            <td>Aprobado</td>
                        @elseif ($so->estado == 'C')
                            <td>Cancelado</td>
                        @elseif ($so->estado == 'R')
                            <td>Rechazado</td>
                        @elseif ($so->estado == null)
                            <td> Pendiente de aprobación </td>
                        @endif

                        <td>{{ $so->fecha_solicitud }}</td>


                        @foreach ($tipocredito as $tipo)
                            @if ($so->tipo_credito_id == $tipo->id)
                                <td>{{ $tipo->nombrecredito }}</td>
                                @php
                                    $foundMatch = true;
                                    break; // Termina el bucle una vez que se ha encontrado una coincidencia
                                @endphp
                            @endif
                        @endforeach


                        <td>{{ $so->observaciones_asesor }}</td>

                        <td>

                            <a href="{{ route('solicitacredito.edit', ['id' => $so->id]) }}" class="submit btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                            </a>

                            @if (auth()->check() && (auth()->user()->rol == 'admin' || auth()->user()->rol == 'gerente'))
                                <a href="{{ route('solicitacredito.destroy', ['id' => $so->id]) }}" class="btn btn-danger">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                </a>
                            @endif


                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>


@endsection
